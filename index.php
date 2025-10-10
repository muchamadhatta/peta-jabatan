<?php
// Include data class
require_once 'data/jabatan-data.php';

// Peta Jabatan - Struktur Organisasi
$title = "Peta Jabatan - Struktur Organisasi";
$description = "Visualisasi interaktif struktur organisasi";

// Get data from class
$orgData = DataJabatan::getFullOrganizationData();
$summaryStats = DataJabatan::getSummaryStatistics();
?>
<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title><?php echo $title; ?></title>
    
    <!-- External Libraries -->
    <script src="https://d3js.org/d3.v7.min.js"></script>
    
    <!-- Custom Styles -->
    <link rel="stylesheet" href="assets/css/style.css">
    
    <!-- Favicon -->
    <link rel="icon" type="image/x-icon" href="assets/images/favicon.ico">
</head>
<body>
    <div class="container">
        <div class="main-content">
            <div class="header">
                <h1><?php echo $title; ?></h1>
                <p><?php echo $description; ?> dengan detail jabatan lengkap</p>
            </div>

            <div class="content-section">
                <div class="stats-summary">
                    <h3>📊 Ringkasan Statistik Jabatan</h3>
                    <div class="stats-grid">
                        <div class="stat-item">
                            <div class="label">Total Formasi (B)</div>
                            <div class="value"><?php echo $summaryStats['total_formasi']; ?></div>
                        </div>
                        <div class="stat-item">
                            <div class="label">Total Kondisi (K)</div>
                            <div class="value"><?php echo $summaryStats['total_kondisi']; ?></div>
                        </div>
                        <div class="stat-item <?php echo $summaryStats['total_selisih'] < 0 ? 'negative' : 'positive'; ?>">
                            <div class="label">Selisih Total</div>
                            <div class="value"><?php echo $summaryStats['total_selisih']; ?></div>
                        </div>
                        <div class="stat-item">
                            <div class="label">Pimpinan Tinggi</div>
                            <div class="value"><?php echo $summaryStats['jabatan_pimpinan_tinggi']['B'] . ' / ' . $summaryStats['jabatan_pimpinan_tinggi']['K']; ?></div>
                        </div>
                        <div class="stat-item">
                            <div class="label">Administrasi</div>
                            <div class="value"><?php echo $summaryStats['jabatan_administrasi']['B'] . ' / ' . $summaryStats['jabatan_administrasi']['K']; ?></div>
                        </div>
                        <div class="stat-item">
                            <div class="label">Fungsional</div>
                            <div class="value"><?php echo $summaryStats['jabatan_fungsional']['B'] . ' / ' . $summaryStats['jabatan_fungsional']['K']; ?></div>
                        </div>
                        <div class="stat-item">
                            <div class="label">Pelaksana</div>
                            <div class="value"><?php echo $summaryStats['jabatan_pelaksana']['B'] . ' / ' . $summaryStats['jabatan_pelaksana']['K']; ?></div>
                        </div>
                    </div>
                </div>

                <div class="legend">
                    <div class="legend-item">
                        <div class="legend-color level-1"></div>
                        <span>Unit Kerja Utama</span>
                    </div>
                    <div class="legend-item">
                        <div class="legend-color level-2"></div>
                        <span>Jabatan Administrator</span>
                    </div>
                    <div class="legend-item">
                        <div class="legend-color level-3"></div>
                        <span>Jabatan Fungsional</span>
                    </div>
                    <div class="legend-item">
                        <div class="legend-color level-4"></div>
                        <span>Jabatan Pelaksana</span>
                    </div>
                </div>

                <div class="controls">
                    <button onclick="petaJabatan.fit()" class="primary">🔍 Pas ke Layar</button>
                    <button onclick="petaJabatan.zoomIn()" class="primary">🔍+ Perbesar</button>
                    <button onclick="petaJabatan.zoomOut()" class="primary">🔍- Perkecil</button>
                    <button onclick="petaJabatan.expandAll()" class="secondary">📂 Buka Semua</button>
                    <button onclick="petaJabatan.collapseAll()" class="secondary">📁 Tutup Semua</button>
                    <button onclick="petaJabatan.exportPNG()" class="accent">📸 Export PNG</button>
                    <button onclick="petaJabatan.exportPDF()" class="accent">📄 Export PDF</button>
                    <button onclick="PetaJabatanUtils.printChart()" class="accent">🖨️ Print</button>
                </div>

                <div id="tree"></div>
            </div>
        </div>
    </div>

    <!-- Loading indicator -->
    <div id="loading" class="loading" style="display: none;">
        <div class="spinner"></div>
    </div>

    <script>
        // Data dari PHP ke JavaScript
        const orgData = <?php echo json_encode($orgData); ?>;
        
        // Global variables
        let svg, g, zoom, simulation;
        let nodes = [], links = [];
        
        // Chart dimensions
        const width = 1200;
        const height = 800;
        const nodeWidth = 250;
        const nodeHeight = 80;

        // Initialize chart when page loads
        document.addEventListener('DOMContentLoaded', function() {
            // Show loading
            document.getElementById('loading').style.display = 'flex';
            
            try {
                initializeChart();
                console.log('Peta Jabatan berhasil diinisialisasi dengan', orgData.length, 'node');
                
                // Hide loading after initialization
                setTimeout(() => {
                    document.getElementById('loading').style.display = 'none';
                }, 1000);
                
            } catch (error) {
                console.error('Error initializing Peta Jabatan:', error);
                document.getElementById('loading').style.display = 'none';
                alert('Terjadi kesalahan saat memuat peta jabatan. Silakan refresh halaman.');
            }
        });

        function initializeChart() {
            // Prepare data
            processData();
            
            // Create SVG
            const container = d3.select("#tree");
            
            svg = container.append("svg")
                .attr("width", "100%")
                .attr("height", "100%")
                .attr("viewBox", `0 0 ${width} ${height}`)
                .style("background", "#f8f9fa");

            // Create zoom behavior
            zoom = d3.zoom()
                .scaleExtent([0.1, 3])
                .on("zoom", (event) => {
                    g.attr("transform", event.transform);
                });

            svg.call(zoom);

            // Create main group
            g = svg.append("g");

            // Create force simulation
            simulation = d3.forceSimulation(nodes)
                .force("link", d3.forceLink(links).id(d => d.id).distance(150).strength(0.8))
                .force("charge", d3.forceManyBody().strength(-800))
                .force("center", d3.forceCenter(width / 2, height / 2))
                .force("collision", d3.forceCollide().radius(nodeWidth / 2 + 20));

            drawChart();
        }

        function processData() {
            // Convert orgData to D3 format
            nodes = orgData.map(d => ({
                id: d.id,
                name: d.name,
                B: d.B,
                K: d.K,
                selisih: d.selisih,
                template: d.template,
                level: d.level,
                description: d.description || '',
                fx: null,
                fy: null
            }));

            // Create links based on parent-child relationships
            links = [];
            orgData.forEach(d => {
                if (d.pid) {
                    links.push({
                        source: d.pid,
                        target: d.id
                    });
                }
            });

            // Set fixed positions for root and main branches
            const root = nodes.find(n => n.id === 1);
            if (root) {
                root.fx = width / 2;
                root.fy = 100;
            }

            // Position main administrators
            const administrators = nodes.filter(n => n.level === 2);
            administrators.forEach((admin, i) => {
                admin.fx = (width / (administrators.length + 1)) * (i + 1);
                admin.fy = 250;
            });
        }

        function drawChart() {
            // Draw links
            const link = g.append("g")
                .attr("class", "links")
                .selectAll("line")
                .data(links)
                .enter().append("line")
                .attr("stroke", "#666")
                .attr("stroke-width", 2)
                .attr("stroke-opacity", 0.6);

            // Draw nodes
            const node = g.append("g")
                .attr("class", "nodes")
                .selectAll("g")
                .data(nodes)
                .enter().append("g")
                .attr("class", "node")
                .call(d3.drag()
                    .on("start", dragstarted)
                    .on("drag", dragged)
                    .on("end", dragended))
                .on("click", showNodeDetails);

            // Add rectangles for nodes
            node.append("rect")
                .attr("width", nodeWidth)
                .attr("height", nodeHeight)
                .attr("x", -nodeWidth/2)
                .attr("y", -nodeHeight/2)
                .attr("rx", 8)
                .attr("ry", 8)
                .attr("fill", d => getNodeColor(d.template))
                .attr("stroke", d => getNodeStrokeColor(d.template))
                .attr("stroke-width", 2)
                .style("filter", "drop-shadow(0 3px 6px rgba(0,0,0,0.16))");

            // Add main text (name)
            node.append("text")
                .attr("class", "node-title")
                .attr("text-anchor", "middle")
                .attr("y", -15)
                .style("font-size", "12px")
                .style("font-weight", "bold")
                .style("fill", "white")
                .text(d => truncateText(d.name, 30))
                .append("title")
                .text(d => d.name);

            // Add statistics text
            node.append("text")
                .attr("class", "node-stats")
                .attr("text-anchor", "middle")
                .attr("y", 5)
                .style("font-size", "10px")
                .style("fill", "white")
                .text(d => `B: ${d.B} | K: ${d.K}`);

            // Add selisih text
            node.append("text")
                .attr("class", "node-selisih")
                .attr("text-anchor", "middle")
                .attr("y", 20)
                .style("font-size", "10px")
                .style("font-weight", "bold")
                .style("fill", "white")
                .text(d => `Selisih: ${d.selisih}`);

            // Update positions on simulation tick
            simulation.on("tick", () => {
                link
                    .attr("x1", d => d.source.x)
                    .attr("y1", d => d.source.y)
                    .attr("x2", d => d.target.x)
                    .attr("y2", d => d.target.y);

                node.attr("transform", d => `translate(${d.x},${d.y})`);
            });
        }

        function getNodeColor(template) {
            const colors = {
                'unit_kerja': '#4CAF50',
                'administrator': '#2196F3',
                'fungsional': '#FF9800',
                'pelaksana': '#9C27B0'
            };
            return colors[template] || '#757575';
        }

        function getNodeStrokeColor(template) {
            const colors = {
                'unit_kerja': '#2E7D32',
                'administrator': '#1565C0',
                'fungsional': '#E65100',
                'pelaksana': '#6A1B9A'
            };
            return colors[template] || '#424242';
        }

        function truncateText(text, maxLength) {
            if (text.length <= maxLength) return text;
            return text.substring(0, maxLength - 3) + '...';
        }

        function showNodeDetails(event, d) {
            const message = `${d.name}\n\nFormasi (B): ${d.B}\nKondisi (K): ${d.K}\nSelisih: ${d.selisih}\n\nDeskripsi: ${d.description}`;
            alert(message);
        }

        // Drag functions
        function dragstarted(event, d) {
            if (!event.active) simulation.alphaTarget(0.3).restart();
            d.fx = d.x;
            d.fy = d.y;
        }

        function dragged(event, d) {
            d.fx = event.x;
            d.fy = event.y;
        }

        function dragended(event, d) {
            if (!event.active) simulation.alphaTarget(0);
            // Keep nodes fixed after dragging
            // d.fx = null;
            // d.fy = null;
        }

        // Control functions
        const petaJabatan = {
            fit: function() {
                const bounds = g.node().getBBox();
                const fullWidth = bounds.width;
                const fullHeight = bounds.height;
                const scale = Math.min(width / fullWidth, height / fullHeight) * 0.8;
                const translate = [width / 2 - scale * (bounds.x + fullWidth / 2), 
                                height / 2 - scale * (bounds.y + fullHeight / 2)];
                
                svg.transition().duration(750).call(
                    zoom.transform,
                    d3.zoomIdentity.translate(translate[0], translate[1]).scale(scale)
                );
            },
            
            zoomIn: function() {
                svg.transition().call(zoom.scaleBy, 1.5);
            },
            
            zoomOut: function() {
                svg.transition().call(zoom.scaleBy, 1 / 1.5);
            },
            
            expandAll: function() {
                simulation.alpha(1).restart();
            },
            
            collapseAll: function() {
                simulation.stop();
            },
            
            exportPNG: function() {
                const canvas = document.createElement('canvas');
                const context = canvas.getContext('2d');
                const svgData = new XMLSerializer().serializeToString(svg.node());
                const img = new Image();
                
                canvas.width = width;
                canvas.height = height;
                
                img.onload = function() {
                    context.fillStyle = 'white';
                    context.fillRect(0, 0, width, height);
                    context.drawImage(img, 0, 0);
                    
                    const link = document.createElement('a');
                    link.download = `peta-jabatan-${new Date().toISOString().split('T')[0]}.png`;
                    link.href = canvas.toDataURL();
                    link.click();
                };
                
                img.src = 'data:image/svg+xml;base64,' + btoa(unescape(encodeURIComponent(svgData)));
            },
            
            exportPDF: function() {
                window.print();
            }
        };

        // Additional functions for PHP integration
        function searchJabatan() {
            const query = prompt('Masukkan kata kunci pencarian:');
            if (query) {
                const found = nodes.find(n => n.name.toLowerCase().includes(query.toLowerCase()));
                if (found) {
                    // Highlight and center on found node
                    svg.transition().duration(750).call(
                        zoom.transform,
                        d3.zoomIdentity.translate(width/2 - found.x, height/2 - found.y).scale(1.5)
                    );
                    showNodeDetails(null, found);
                } else {
                    alert('Jabatan tidak ditemukan');
                }
            }
        }

        function showStatistics() {
            const stats = <?php echo json_encode($summaryStats); ?>;
            let message = 'Statistik Jabatan:\n\n';
            message += `Total Formasi (B): ${stats.total_formasi}\n`;
            message += `Total Kondisi (K): ${stats.total_kondisi}\n`;
            message += `Selisih: ${stats.total_selisih}\n\n`;
            message += `Jabatan Pimpinan Tinggi: ${stats.jabatan_pimpinan_tinggi.B}/${stats.jabatan_pimpinan_tinggi.K}\n`;
            message += `Jabatan Administrasi: ${stats.jabatan_administrasi.B}/${stats.jabatan_administrasi.K}\n`;
            message += `Jabatan Fungsional: ${stats.jabatan_fungsional.B}/${stats.jabatan_fungsional.K}\n`;
            message += `Jabatan Pelaksana: ${stats.jabatan_pelaksana.B}/${stats.jabatan_pelaksana.K}`;
            
            alert(message);
        }

        function exportData() {
            const format = prompt('Export format (json/csv):', 'json');
            if (format === 'json' || format === 'csv') {
                window.open(`export.php?format=${format}`, '_blank');
            }
        }

        const PetaJabatanUtils = {
            printChart: function() {
                window.print();
            }
        };

        // Keyboard shortcuts
        document.addEventListener('keydown', function(e) {
            if (e.ctrlKey) {
                switch(e.key) {
                    case '=':
                    case '+':
                        e.preventDefault();
                        petaJabatan.zoomIn();
                        break;
                    case '-':
                        e.preventDefault();
                        petaJabatan.zoomOut();
                        break;
                    case '0':
                        e.preventDefault();
                        petaJabatan.fit();
                        break;
                    case 'f':
                        e.preventDefault();
                        searchJabatan();
                        break;
                    case 'p':
                        e.preventDefault();
                        PetaJabatanUtils.printChart();
                        break;
                    case 's':
                        e.preventDefault();
                        petaJabatan.exportPNG();
                        break;
                }
            }
        });

        // Window resize handler
        window.addEventListener('resize', function() {
            setTimeout(() => {
                petaJabatan.fit();
            }, 300);
        });

        // Auto-fit after load
        window.addEventListener('load', function() {
            setTimeout(() => {
                petaJabatan.fit();
            }, 1500);
        });
    </script>

    <!-- Additional styles for better mobile experience -->
    <style>
        @media (max-width: 768px) {
            #tree {
                height: 70vh;
                min-height: 500px;
            }
            
            .controls button {
                font-size: 12px;
                padding: 6px 12px;
            }
        }
        
        /* Print styles */
        @media print {
            .controls, .stats-summary, .legend {
                display: none !important;
            }
            
            #tree {
                height: 80vh !important;
                border: 1px solid #000 !important;
            }
        }
    </style>
</body>
</html>