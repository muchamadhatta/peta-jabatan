<?php
/**
 * Export Script untuk Peta Jabatan
 * Mengeksport data dalam format JSON atau CSV
 */

// Include data class
require_once 'data/jabatan-data.php';

// Get format from query parameter
$format = isset($_GET['format']) ? strtolower($_GET['format']) : 'json';
$type = isset($_GET['type']) ? $_GET['type'] : 'full';

// Validate format
if (!in_array($format, ['json', 'csv'])) {
    http_response_code(400);
    die('Invalid format. Use json or csv.');
}

// Set appropriate headers
$timestamp = date('Y-m-d_H-i-s');
$filename = "peta-jabatan-{$timestamp}.{$format}";

switch ($format) {
    case 'json':
        header('Content-Type: application/json');
        header('Content-Disposition: attachment; filename="' . $filename . '"');
        
        $data = [];
        switch ($type) {
            case 'summary':
                $data = DataJabatan::getSummaryStatistics();
                break;
            case 'full':
            default:
                $data = [
                    'metadata' => [
                        'title' => 'Peta Jabatan - Struktur Organisasi',
                        'export_date' => date('Y-m-d H:i:s'),
                        'total_nodes' => count(DataJabatan::getFullOrganizationData()),
                        'version' => '1.0'
                    ],
                    'summary' => DataJabatan::getSummaryStatistics(),
                    'organization_data' => DataJabatan::getFullOrganizationData()
                ];
                break;
        }
        
        echo json_encode($data, JSON_PRETTY_PRINT | JSON_UNESCAPED_UNICODE);
        break;
        
    case 'csv':
        header('Content-Type: text/csv');
        header('Content-Disposition: attachment; filename="' . $filename . '"');
        
        echo DataJabatan::exportToCsv();
        break;
}

exit;
?>