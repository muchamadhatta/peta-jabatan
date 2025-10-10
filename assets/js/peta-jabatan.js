/**
 * Peta Jabatan - Interactive Organization Chart
 * JavaScript functionality for organizational structure visualization
 */

class PetaJabatan {
    constructor(containerId, data) {
        this.containerId = containerId;
        this.data = data;
        this.chart = null;
        this.init();
    }

    init() {
        this.setupTemplates();
        this.createChart();
        this.bindEvents();
    }

    setupTemplates() {
        // Template untuk Unit Kerja (Level 1)
        OrgChart.templates.unit_kerja = Object.assign({}, OrgChart.templates.ana);
        OrgChart.templates.unit_kerja.size = [320, 140];
        OrgChart.templates.unit_kerja.node = `
            <rect x="0" y="0" height="140" width="320" 
                  fill="#4CAF50" stroke-width="3" stroke="#2E7D32" 
                  rx="12" ry="12" style="filter: drop-shadow(0 4px 8px rgba(0,0,0,0.2));">
            </rect>
        `;
        OrgChart.templates.unit_kerja.field_0 = '<text class="field_0" style="font-size: 16px; font-weight: bold;" fill="white" x="160" y="35" text-anchor="middle">{val}</text>';
        OrgChart.templates.unit_kerja.field_1 = '<text class="field_1" style="font-size: 14px;" fill="white" x="160" y="65" text-anchor="middle">Formasi (B): {val}</text>';
        OrgChart.templates.unit_kerja.field_2 = '<text class="field_2" style="font-size: 14px;" fill="white" x="160" y="85" text-anchor="middle">Kondisi (K): {val}</text>';
        OrgChart.templates.unit_kerja.field_3 = '<text class="field_3" style="font-size: 14px; font-weight: bold;" fill="white" x="160" y="110" text-anchor="middle">Selisih: {val}</text>';

        // Template untuk Administrator (Level 2)
        OrgChart.templates.administrator = Object.assign({}, OrgChart.templates.ana);
        OrgChart.templates.administrator.size = [290, 110];
        OrgChart.templates.administrator.node = `
            <rect x="0" y="0" height="110" width="290" 
                  fill="#2196F3" stroke-width="2" stroke="#1565C0" 
                  rx="8" ry="8" style="filter: drop-shadow(0 3px 6px rgba(0,0,0,0.15));">
            </rect>
        `;
        OrgChart.templates.administrator.field_0 = '<text class="field_0" style="font-size: 14px; font-weight: bold;" fill="white" x="145" y="30" text-anchor="middle">{val}</text>';
        OrgChart.templates.administrator.field_1 = '<text class="field_1" style="font-size: 12px;" fill="white" x="145" y="55" text-anchor="middle">B: {val}</text>';
        OrgChart.templates.administrator.field_2 = '<text class="field_2" style="font-size: 12px;" fill="white" x="145" y="75" text-anchor="middle">K: {val}</text>';
        OrgChart.templates.administrator.field_3 = '<text class="field_3" style="font-size: 12px; font-weight: bold;" fill="white" x="145" y="95" text-anchor="middle">Selisih: {val}</text>';

        // Template untuk Fungsional (Level 3)
        OrgChart.templates.fungsional = Object.assign({}, OrgChart.templates.ana);
        OrgChart.templates.fungsional.size = [260, 90];
        OrgChart.templates.fungsional.node = `
            <rect x="0" y="0" height="90" width="260" 
                  fill="#FF9800" stroke-width="2" stroke="#E65100" 
                  rx="6" ry="6" style="filter: drop-shadow(0 2px 4px rgba(0,0,0,0.15));">
            </rect>
        `;
        OrgChart.templates.fungsional.field_0 = '<text class="field_0" style="font-size: 13px; font-weight: bold;" fill="white" x="130" y="25" text-anchor="middle">{val}</text>';
        OrgChart.templates.fungsional.field_1 = '<text class="field_1" style="font-size: 11px;" fill="white" x="130" y="45" text-anchor="middle">B: {val}</text>';
        OrgChart.templates.fungsional.field_2 = '<text class="field_2" style="font-size: 11px;" fill="white" x="130" y="60" text-anchor="middle">K: {val}</text>';
        OrgChart.templates.fungsional.field_3 = '<text class="field_3" style="font-size: 11px; font-weight: bold;" fill="white" x="130" y="75" text-anchor="middle">Selisih: {val}</text>';

        // Template untuk Pelaksana (Level 4)
        OrgChart.templates.pelaksana = Object.assign({}, OrgChart.templates.ana);
        OrgChart.templates.pelaksana.size = [230, 80];
        OrgChart.templates.pelaksana.node = `
            <rect x="0" y="0" height="80" width="230" 
                  fill="#9C27B0" stroke-width="2" stroke="#6A1B9A" 
                  rx="5" ry="5" style="filter: drop-shadow(0 2px 4px rgba(0,0,0,0.1));">
            </rect>
        `;
        OrgChart.templates.pelaksana.field_0 = '<text class="field_0" style="font-size: 12px; font-weight: bold;" fill="white" x="115" y="22" text-anchor="middle">{val}</text>';
        OrgChart.templates.pelaksana.field_1 = '<text class="field_1" style="font-size: 10px;" fill="white" x="115" y="40" text-anchor="middle">B: {val}</text>';
        OrgChart.templates.pelaksana.field_2 = '<text class="field_2" style="font-size: 10px;" fill="white" x="115" y="55" text-anchor="middle">K: {val}</text>';
        OrgChart.templates.pelaksana.field_3 = '<text class="field_3" style="font-size: 10px; font-weight: bold;" fill="white" x="115" y="70" text-anchor="middle">Selisih: {val}</text>';
    }

    createChart() {
        this.chart = new OrgChart(document.getElementById(this.containerId), {
            nodes: this.data,
            layout: OrgChart.mixed,
            scaleInitial: 0.8,
            enableDragDrop: false,
            enableSearch: true,
            mouseScrool: OrgChart.action.zoom,
            nodeBinding: {
                field_0: "name",
                field_1: "B",
                field_2: "K", 
                field_3: "selisih"
            },
            editForm: {
                readOnly: true,
                titleBinding: "name",
                photoBinding: "",
                elements: [
                    { type: 'textbox', label: 'Nama Jabatan', binding: 'name' },
                    { type: 'textbox', label: 'Formasi (B)', binding: 'B' },
                    { type: 'textbox', label: 'Kondisi (K)', binding: 'K' },
                    { type: 'textbox', label: 'Selisih', binding: 'selisih' },
                    { type: 'textbox', label: 'Level', binding: 'level' },
                    { type: 'textbox', label: 'Deskripsi', binding: 'description' }
                ]
            },
            menu: {
                export_png: { 
                    text: "Export PNG",
                    icon: OrgChart.icon.png(24, 24, '#ffffff')
                },
                export_pdf: { 
                    text: "Export PDF",
                    icon: OrgChart.icon.pdf(24, 24, '#ffffff')
                },
                export_svg: { 
                    text: "Export SVG",
                    icon: OrgChart.icon.svg(24, 24, '#ffffff')
                }
            },
            toolbar: {
                zoom: true,
                fit: true,
                expandAll: true,
                fullScreen: true
            },
            searchFields: ["name", "B", "K", "selisih"],
            searchFieldsWeight: {
                "name": 100,
                "B": 10,
                "K": 10,
                "selisih": 5
            }
        });
    }

    bindEvents() {
        // Event ketika chart selesai di-render
        this.chart.on('init', () => {
            console.log('Peta Jabatan berhasil dimuat');
            this.autoFit();
        });

        // Event ketika node diklik
        this.chart.on('click', (sender, args) => {
            if (args.node) {
                this.showNodeDetails(args.node);
            }
        });

        // Event ketika chart di-redraw
        this.chart.on('redraw', () => {
            this.updateStatistics();
        });

        // Event untuk export
        this.chart.on('exportstart', (sender, args) => {
            console.log('Memulai export:', args.format);
        });

        this.chart.on('exportend', (sender, args) => {
            console.log('Export selesai:', args.format);
            this.showNotification('File berhasil di-export!', 'success');
        });
    }

    // Fungsi kontrol chart
    zoomIn() {
        this.chart.zoom(true);
    }

    zoomOut() {
        this.chart.zoom(false);
    }

    fit() {
        this.chart.fit();
    }

    autoFit() {
        setTimeout(() => {
            this.chart.fit();
        }, 500);
    }

    expandAll() {
        this.chart.expandAll();
    }

    collapseAll() {
        this.chart.collapseAll();
    }

    centerOnNode(nodeId) {
        this.chart.center(nodeId);
    }

    // Export functions
    exportPNG() {
        const today = new Date().toISOString().split('T')[0];
        this.chart.exportPNG({
            filename: `peta-jabatan-${today}`,
            expandChildren: true,
            margin: [50, 50, 50, 50]
        });
    }

    exportPDF() {
        const today = new Date().toISOString().split('T')[0];
        this.chart.exportPDF({
            filename: `peta-jabatan-${today}`,
            format: 'A3',
            orientation: 'landscape',
            margin: [20, 20, 20, 20]
        });
    }

    exportSVG() {
        const today = new Date().toISOString().split('T')[0];
        this.chart.exportSVG({
            filename: `peta-jabatan-${today}`,
            expandChildren: true
        });
    }

    // Utility functions
    showNodeDetails(node) {
        const details = {
            name: node.name || 'N/A',
            B: node.B || '0',
            K: node.K || '0',
            selisih: node.selisih || '0',
            template: node.template || 'Unknown',
            level: this.getNodeLevel(node.template)
        };

        console.log('Detail Node:', details);
        
        // Bisa diperluas untuk menampilkan modal atau panel detail
        this.showNotification(`${details.name} - B: ${details.B}, K: ${details.K}, Selisih: ${details.selisih}`, 'info');
    }

    getNodeLevel(template) {
        const levelMap = {
            'unit_kerja': 'Unit Kerja Utama',
            'administrator': 'Jabatan Administrator',
            'fungsional': 'Jabatan Fungsional',
            'pelaksana': 'Jabatan Pelaksana'
        };
        return levelMap[template] || 'Unknown';
    }

    updateStatistics() {
        // Update statistik realtime jika diperlukan
        const visibleNodes = this.chart.getVisibleNodeIds();
        console.log(`Menampilkan ${visibleNodes.length} node`);
    }

    searchNode(query) {
        if (this.chart.searchUI) {
            this.chart.searchUI.find(query);
        }
    }

    // Notification system
    showNotification(message, type = 'info') {
        // Implementasi sederhana notification
        const notification = document.createElement('div');
        notification.className = `notification ${type}`;
        notification.textContent = message;
        notification.style.cssText = `
            position: fixed;
            top: 20px;
            right: 20px;
            padding: 12px 20px;
            background: ${type === 'success' ? '#4CAF50' : type === 'error' ? '#f44336' : '#2196F3'};
            color: white;
            border-radius: 4px;
            box-shadow: 0 2px 10px rgba(0,0,0,0.2);
            z-index: 10000;
            opacity: 0;
            transition: opacity 0.3s ease;
        `;

        document.body.appendChild(notification);
        
        // Animate in
        setTimeout(() => {
            notification.style.opacity = '1';
        }, 100);

        // Remove after 3 seconds
        setTimeout(() => {
            notification.style.opacity = '0';
            setTimeout(() => {
                if (notification.parentNode) {
                    notification.parentNode.removeChild(notification);
                }
            }, 300);
        }, 3000);
    }

    // Data management
    addNode(nodeData) {
        this.chart.addNode(nodeData);
    }

    removeNode(nodeId) {
        this.chart.removeNode(nodeId);
    }

    updateNode(nodeData) {
        this.chart.updateNode(nodeData);
    }

    // Get chart data
    getChartData() {
        return this.chart.config.nodes;
    }

    // Destroy chart
    destroy() {
        if (this.chart) {
            this.chart.destroy();
            this.chart = null;
        }
    }
}

// Utility functions
const PetaJabatanUtils = {
    // Format angka dengan pemisah ribuan
    formatNumber: (num) => {
        return new Intl.NumberFormat('id-ID').format(num);
    },

    // Hitung persentase
    calculatePercentage: (current, total) => {
        if (total === 0) return 0;
        return Math.round((current / total) * 100);
    },

    // Generate random color
    generateColor: () => {
        const colors = ['#4CAF50', '#2196F3', '#FF9800', '#9C27B0', '#F44336', '#795548'];
        return colors[Math.floor(Math.random() * colors.length)];
    },

    // Download file
    downloadFile: (content, filename, contentType = 'text/plain') => {
        const blob = new Blob([content], { type: contentType });
        const url = window.URL.createObjectURL(blob);
        const link = document.createElement('a');
        link.href = url;
        link.download = filename;
        document.body.appendChild(link);
        link.click();
        document.body.removeChild(link);
        window.URL.revokeObjectURL(url);
    },

    // Print chart
    printChart: () => {
        window.print();
    }
};

// Export untuk digunakan di file lain
if (typeof module !== 'undefined' && module.exports) {
    module.exports = { PetaJabatan, PetaJabatanUtils };
}