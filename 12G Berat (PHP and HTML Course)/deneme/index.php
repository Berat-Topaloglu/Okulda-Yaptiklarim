<?php
/**
 * NEXUS-OS V1.0 - ULTIMATE SINGLE FILE PHP SYSTEM
 * 
 * MİMARİ:
 * - Core Kernel: İstekleri işler, routing yapar.
 * - Virtual File System (VFS): Session tabanlı dosya sistemi.
 * - NexusDB: JSON tabanlı NoSQL veritabanı motoru.
 * - Terminal Emulator: Komut satırı arayüzü.
 * - Module Manager: Dinamik modül yükleyici.
 */

session_start();
error_reporting(E_ALL);
ini_set('display_errors', 0); // Prodüksiyon modu (Hataları UI'da göstermemek için)

// --- 1. CORE KERNEL & UTILITIES ---

trait SecurityTrait {
    public function sanitize($data) {
        return htmlspecialchars(strip_tags(trim($data)));
    }
    public function generateToken() {
        if (empty($_SESSION['csrf_token'])) {
            $_SESSION['csrf_token'] = bin2hex(random_bytes(32));
        }
        return $_SESSION['csrf_token'];
    }
}

interface IModule {
    public function render();
    public function getName();
}

class SystemKernel {
    use SecurityTrait;
    private $modules = [];
    private $activeModule;

    public function __construct() {
        $this->initSession();
        $this->registerModules();
        $this->handleRequest();
    }

    private function initSession() {
        if (!isset($_SESSION['nexus_os'])) {
            $_SESSION['nexus_os'] = [
                'boot_time' => time(),
                'version' => '1.0.0 Pro',
                'user' => 'root',
                'filesystem' => [
                    'home' => ['type' => 'dir', 'content' => []],
                    'var' => ['type' => 'dir', 'content' => [
                        'logs' => ['type' => 'file', 'content' => 'System booted...']
                    ]],
                ],
                'db' => [], // Sanal Veritabanı
                'tasks' => []
            ];
        }
    }

    private function registerModules() {
        $this->modules['dashboard'] = new DashboardModule();
        $this->modules['terminal'] = new TerminalModule();
        $this->modules['filemanager'] = new FileManagerModule();
        $this->modules['editor'] = new CodeEditorModule();
        $this->modules['database'] = new DatabaseModule();
        $this->modules['kanban'] = new KanbanModule();
    }

    private function handleRequest() {
        // Global POST işlemleri (Terminal komutları, Dosya işlemleri vb.)
        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            if (isset($_POST['global_action'])) {
                $this->routePost($_POST['global_action']);
            }
        }

        $page = $_GET['app'] ?? 'dashboard';
        if (array_key_exists($page, $this->modules)) {
            $this->activeModule = $this->modules[$page];
        } else {
            $this->activeModule = $this->modules['dashboard'];
        }
    }

    private function routePost($action) {
        // Basit bir Router
        switch ($action) {
            case 'exec_cmd': (new TerminalModule())->execute($_POST['cmd']); break;
            case 'save_file': (new FileManagerModule())->saveFile($_POST['filename'], $_POST['content']); break;
            case 'db_query': (new DatabaseModule())->executeQuery($_POST['query']); break;
            case 'add_task': (new KanbanModule())->addTask($_POST['task'], $_POST['status']); break;
            case 'reset_os': session_destroy(); header("Location: ?"); exit;
        }
    }

    public function renderUI() {
        $activeModuleName = $this->activeModule->getName();
        // View Katmanı
        include __FILE__; // Kendini include etmez, aşağıda HTML render kısmına geçmek için akışı sağlar ama biz HTML'i fonksiyon içinde return edeceğiz.
        // Tek dosya yapısında HTML'i aşağıda yazdıracağız.
    }

    public function getModuleContent() {
        return $this->activeModule->render();
    }

    public function getNav() {
        $html = '';
        foreach ($this->modules as $key => $module) {
            $active = ($_GET['app'] ?? 'dashboard') == $key ? 'active' : '';
            $icon = $module->getIcon();
            $name = ucfirst($key);
            $html .= "<a href='?app=$key' class='nav-link $active'><i class='$icon me-2'></i> $name</a>";
        }
        return $html;
    }
}

// --- 2. MODÜLLER (UYGULAMALAR) ---

abstract class BaseModule implements IModule {
    abstract public function getIcon();
}

class DashboardModule extends BaseModule {
    public function getName() { return "System Dashboard"; }
    public function getIcon() { return "fa-solid fa-chart-line"; }
    public function render() {
        $uptime = time() - $_SESSION['nexus_os']['boot_time'];
        $ramUsage = rand(20, 85); // Simülasyon
        $cpuUsage = rand(5, 95);  // Simülasyon
        
        return "
        <div class='row'>
            <div class='col-md-3 mb-3'><div class='card bg-primary text-white'><div class='card-body'><h3>CPU</h3><h2>{$cpuUsage}%</h2></div></div></div>
            <div class='col-md-3 mb-3'><div class='card bg-success text-white'><div class='card-body'><h3>RAM</h3><h2>{$ramUsage}%</h2></div></div></div>
            <div class='col-md-3 mb-3'><div class='card bg-warning text-dark'><div class='card-body'><h3>UPTIME</h3><h2>{$uptime}s</h2></div></div></div>
            <div class='col-md-3 mb-3'><div class='card bg-danger text-white'><div class='card-body'><h3>DISK</h3><h2>Virtual</h2></div></div></div>
        </div>
        <div class='row mt-4'>
            <div class='col-md-8'>
                <div class='card bg-dark text-white border-secondary'>
                    <div class='card-header'>Live Traffic Analysis</div>
                    <div class='card-body'><canvas id='trafficChart'></canvas></div>
                </div>
            </div>
            <div class='col-md-4'>
                <div class='card bg-dark text-white border-secondary'>
                    <div class='card-header'>System Logs</div>
                    <div class='card-body code-font small text-success' style='height:300px; overflow-y:auto;'>
                        [INFO] Kernel init... OK<br>
                        [INFO] VFS mounting... OK<br>
                        [INFO] NexusDB Service started.<br>
                        [WARN] CPU Temp High (Simulated)<br>
                        ".str_repeat("[INFO] Listening on port 80...<br>", 10)."
                    </div>
                </div>
            </div>
        </div>";
    }
}

class TerminalModule extends BaseModule {
    public function getName() { return "Terminal Emulator"; }
    public function getIcon() { return "fa-solid fa-terminal"; }
    public function execute($cmd) {
        $output = "";
        $cmd = trim($cmd);
        $parts = explode(' ', $cmd);
        $command = $parts[0];

        if ($command == 'help') $output = "Commands: help, ls, whoami, date, clear, echo [text], sysinfo";
        elseif ($command == 'ls') $output = implode("  ", array_keys($_SESSION['nexus_os']['filesystem']));
        elseif ($command == 'whoami') $output = $_SESSION['nexus_os']['user'];
        elseif ($command == 'date') $output = date('Y-m-d H:i:s');
        elseif ($command == 'echo') $output = substr($cmd, 5);
        elseif ($command == 'sysinfo') $output = "NEXUS OS v1.0 | PHP " . phpversion() . " | Linux Kernel (Simulated)";
        else $output = "Command not found: $command";

        $_SESSION['term_history'][] = ['cmd' => $cmd, 'out' => $output];
    }
    public function render() {
        $historyHtml = '';
        if (isset($_SESSION['term_history'])) {
            foreach ($_SESSION['term_history'] as $h) {
                $historyHtml .= "<div class='text-muted'>$ user@nexus:~$ " . htmlspecialchars($h['cmd']) . "</div>";
                $historyHtml .= "<div class='text-success mb-2'>" . htmlspecialchars($h['out']) . "</div>";
            }
        }
        return "
        <div class='card bg-black text-white border-secondary' style='min-height:70vh;'>
            <div class='card-header'>root@nexus-server:~ (bash)</div>
            <div class='card-body font-monospace' style='overflow-y:auto; max-height:60vh;'>
                $historyHtml
            </div>
            <div class='card-footer bg-dark'>
                <form method='POST'>
                    <input type='hidden' name='global_action' value='exec_cmd'>
                    <div class='input-group'>
                        <span class='input-group-text bg-black text-success border-secondary'>$</span>
                        <input type='text' name='cmd' class='form-control bg-black text-white border-secondary' autofocus autocomplete='off' placeholder='Enter command...'>
                        <button class='btn btn-success'>Run</button>
                    </div>
                </form>
            </div>
        </div>";
    }
}

class FileManagerModule extends BaseModule {
    public function getName() { return "VFS Manager"; }
    public function getIcon() { return "fa-solid fa-folder-tree"; }
    public function saveFile($name, $content) {
        $_SESSION['nexus_os']['filesystem'][$name] = ['type'=>'file', 'content'=>$content];
    }
    public function render() {
        $files = $_SESSION['nexus_os']['filesystem'];
        $list = "";
        foreach($files as $name => $data) {
            $icon = $data['type'] == 'dir' ? 'fa-folder text-warning' : 'fa-file-code text-info';
            $contentEsc = htmlspecialchars(substr($data['content'] ?? '', 0, 50));
            $list .= "<tr><td><i class='fa $icon'></i> $name</td><td>{$data['type']}</td><td>$contentEsc...</td></tr>";
        }
        return "
        <div class='row'>
            <div class='col-md-8'>
                <div class='card bg-dark text-white border-secondary'>
                    <div class='card-header'>File Explorer (Virtual)</div>
                    <table class='table table-dark table-hover mb-0'>
                        <thead><tr><th>Name</th><th>Type</th><th>Preview</th></tr></thead>
                        <tbody>$list</tbody>
                    </table>
                </div>
            </div>
            <div class='col-md-4'>
                <div class='card bg-dark text-white border-secondary'>
                    <div class='card-header'>Create/Edit File</div>
                    <div class='card-body'>
                        <form method='POST'>
                            <input type='hidden' name='global_action' value='save_file'>
                            <div class='mb-2'>
                                <label>Filename</label>
                                <input type='text' name='filename' class='form-control bg-secondary text-white border-0' required>
                            </div>
                            <div class='mb-2'>
                                <label>Content</label>
                                <textarea name='content' class='form-control bg-secondary text-white border-0' rows='5'></textarea>
                            </div>
                            <button class='btn btn-primary w-100'>Save to VFS</button>
                        </form>
                    </div>
                </div>
            </div>
        </div>";
    }
}

class DatabaseModule extends BaseModule {
    public function getName() { return "NexusDB (NoSQL)"; }
    public function getIcon() { return "fa-solid fa-database"; }
    public function executeQuery($query) {
        // Çok basit bir parser: CREATE table, INSERT INTO table value
        $parts = explode(" ", $query);
        $cmd = strtoupper($parts[0]);
        $msg = "";
        
        if ($cmd === "CREATE") {
            $table = $parts[1];
            if (!isset($_SESSION['nexus_os']['db'][$table])) {
                $_SESSION['nexus_os']['db'][$table] = [];
                $msg = "Table '$table' created.";
            } else { $msg = "Table exists."; }
        } elseif ($cmd === "INSERT") {
            // INSERT INTO users data
            $table = $parts[2];
            $data = implode(" ", array_slice($parts, 3));
            if (isset($_SESSION['nexus_os']['db'][$table])) {
                $_SESSION['nexus_os']['db'][$table][] = $data;
                $msg = "Record added to '$table'.";
            } else { $msg = "Table not found."; }
        } elseif ($cmd === "SELECT") {
            // Sadece gösterim render'da yapılır, loga ekleyelim
            $msg = "Selection executed.";
        } else {
            $msg = "Syntax Error. Use: CREATE [name] OR INSERT INTO [name] [data]";
        }
        $_SESSION['db_msg'] = $msg;
    }
    public function render() {
        $tablesHtml = "";
        foreach ($_SESSION['nexus_os']['db'] as $tblName => $rows) {
            $rowsHtml = "";
            foreach($rows as $r) $rowsHtml .= "<div class='badge bg-secondary me-1'>$r</div>";
            $tablesHtml .= "<div class='mb-3'><h5><i class='fa fa-table'></i> $tblName</h5><div class='p-2 border border-secondary rounded'>$rowsHtml</div></div>";
        }
        $msg = $_SESSION['db_msg'] ?? 'Ready.';
        return "
        <div class='row'>
            <div class='col-md-12 mb-3'>
                <form method='POST' class='d-flex gap-2'>
                    <input type='hidden' name='global_action' value='db_query'>
                    <input type='text' name='query' class='form-control bg-dark text-warning font-monospace' placeholder='SQL Console: CREATE users OR INSERT INTO users ahmet'>
                    <button class='btn btn-warning'>Execute</button>
                </form>
                <div class='text-info mt-1'>Output: $msg</div>
            </div>
            <div class='col-md-12'>
                <div class='card bg-dark text-white border-secondary'>
                    <div class='card-header'>Data Viewer</div>
                    <div class='card-body'>$tablesHtml</div>
                </div>
            </div>
        </div>";
    }
}

class CodeEditorModule extends BaseModule {
    public function getName() { return "Dev Studio"; }
    public function getIcon() { return "fa-solid fa-code"; }
    public function render() {
        return "
        <div class='row h-100'>
            <div class='col-md-2 border-end border-secondary'>
                <div class='text-muted small'>PROJECT</div>
                <ul class='list-unstyled ps-2'>
                    <li class='text-white'><i class='fa fa-file-code text-info'></i> index.php</li>
                    <li class='text-white'><i class='fa fa-file-code text-warning'></i> style.css</li>
                    <li class='text-white'><i class='fa fa-file-js text-danger'></i> app.js</li>
                </ul>
            </div>
            <div class='col-md-10'>
                <textarea class='form-control bg-black text-success border-0 font-monospace' style='height:70vh; resize:none;' spellcheck='false'>
function NexusOS() {
    console.log('System initializing...');
    // This is a simulated IDE interface
    // You can type here but it won't execute real PHP
    return true;
}
                </textarea>
                <div class='bg-dark text-white p-2 small border-top border-secondary'>
                    Ln 1, Col 1 | UTF-8 | PHP
                </div>
            </div>
        </div>";
    }
}

class KanbanModule extends BaseModule {
    public function getName() { return "Task Master"; }
    public function getIcon() { return "fa-solid fa-clipboard-check"; }
    public function addTask($task, $status) {
        $_SESSION['nexus_os']['tasks'][] = ['id'=>uniqid(), 'task'=>$task, 'status'=>$status];
    }
    public function render() {
        $cols = ['todo'=>'Yapılacak', 'progress'=>'Sürüyor', 'done'=>'Bitti'];
        $html = "<div class='row'>";
        foreach($cols as $key => $title) {
            $tasksHtml = "";
            foreach($_SESSION['nexus_os']['tasks'] as $t) {
                if($t['status'] == $key) {
                    $tasksHtml .= "<div class='card bg-secondary text-white mb-2 p-2'>{$t['task']}</div>";
                }
            }
            $html .= "
            <div class='col-md-4'>
                <div class='card bg-dark text-white h-100 border-secondary'>
                    <div class='card-header border-secondary text-center font-weight-bold'>$title</div>
                    <div class='card-body' style='background:#1a1a1a;'>
                        $tasksHtml
                        <form method='POST' class='mt-2'>
                            <input type='hidden' name='global_action' value='add_task'>
                            <input type='hidden' name='status' value='$key'>
                            <div class='input-group input-group-sm'>
                                <input type='text' name='task' class='form-control bg-dark text-white border-secondary' placeholder='+ Ekle'>
                                <button class='btn btn-outline-light'>+</button>
                            </div>
                        </form>
                    </div>
                </div>
            </div>";
        }
        $html .= "</div>";
        return $html;
    }
}

// --- 3. UYGULAMAYI BAŞLAT ---
$system = new SystemKernel();

?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>NEXUS-OS | Advanced Single File System</title>
    <!-- Bootstrap 5 Dark & FontAwesome -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
    <!-- Google Fonts -->
    <link href="https://fonts.googleapis.com/css2?family=Fira+Code:wght@400;700&family=Rajdhani:wght@400;600&display=swap" rel="stylesheet">
    <!-- Chart.js -->
    <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>

    <style>
        :root {
            --sidebar-width: 260px;
            --bg-dark: #121212;
            --bg-card: #1e1e1e;
            --accent: #00d2ff;
            --text-main: #e0e0e0;
        }
        body { background-color: var(--bg-dark); color: var(--text-main); font-family: 'Rajdhani', sans-serif; overflow-x: hidden; }
        .code-font { font-family: 'Fira Code', monospace; }
        
        /* Sidebar Styling */
        .sidebar {
            position: fixed; top: 0; bottom: 0; left: 0;
            width: var(--sidebar-width);
            background: linear-gradient(180deg, #0a0a0a 0%, #1a1a1a 100%);
            border-right: 1px solid #333;
            padding: 20px; z-index: 1000;
        }
        .sidebar .logo { font-size: 24px; font-weight: bold; color: var(--accent); margin-bottom: 30px; letter-spacing: 2px; }
        .nav-link { color: #888; padding: 12px 15px; border-radius: 8px; margin-bottom: 5px; transition: 0.3s; font-size: 18px; }
        .nav-link:hover, .nav-link.active { background: rgba(0, 210, 255, 0.1); color: var(--accent); transform: translateX(5px); }
        .nav-link i { width: 25px; }

        /* Main Content */
        .main-content { margin-left: var(--sidebar-width); padding: 30px; min-height: 100vh; }
        
        /* Glassmorphism Cards */
        .card { background: var(--bg-card); border: 1px solid #333; backdrop-filter: blur(10px); box-shadow: 0 4px 15px rgba(0,0,0,0.5); }
        .card-header { background: rgba(255,255,255,0.05); border-bottom: 1px solid #333; font-weight: 600; text-transform: uppercase; letter-spacing: 1px; }
        
        /* Form Elements */
        .form-control:focus { background-color: #222; color: #fff; border-color: var(--accent); box-shadow: 0 0 10px rgba(0,210,255,0.3); }
        
        /* Scrollbar */
        ::-webkit-scrollbar { width: 8px; }
        ::-webkit-scrollbar-track { background: #0a0a0a; }
        ::-webkit-scrollbar-thumb { background: #444; border-radius: 4px; }
        ::-webkit-scrollbar-thumb:hover { background: var(--accent); }

        /* Animations */
        @keyframes fadeIn { from { opacity: 0; transform: translateY(20px); } to { opacity: 1; transform: translateY(0); } }
        .fade-in { animation: fadeIn 0.5s ease-out; }
    </style>
</head>
<body>

<!-- SIDEBAR -->
<div class="sidebar">
    <div class="logo"><i class="fa-solid fa-microchip"></i> NEXUS-OS</div>
    <div class="user-info mb-4 d-flex align-items-center">
        <div class="bg-primary rounded-circle d-flex align-items-center justify-content-center text-white me-3" style="width:40px; height:40px;">R</div>
        <div>
            <div class="text-white small fw-bold">Root User</div>
            <div class="text-success small" style="font-size:12px;">● Online</div>
        </div>
    </div>
    <nav class="nav flex-column">
        <?= $system->getNav() ?>
        <hr class="border-secondary">
        <form method="POST">
            <input type="hidden" name="global_action" value="reset_os">
            <button class="nav-link w-100 text-start border-0 bg-transparent text-danger"><i class="fa-solid fa-power-off me-2"></i> Shutdown</button>
        </form>
    </nav>
</div>

<!-- MAIN CONTENT -->
<div class="main-content">
    <div class="container-fluid fade-in">
        <div class="d-flex justify-content-between align-items-center mb-4">
            <h2 class="text-white fw-light"><?= $_GET['app'] ? strtoupper($_GET['app']) : 'DASHBOARD' ?> <span class="text-muted small">v1.0</span></h2>
            <div class="text-muted small"><i class="far fa-clock"></i> <?= date('d M Y, H:i') ?></div>
        </div>
        
        <!-- MODULE OUTPUT -->
        <?= $system->getModuleContent() ?>
        
    </div>
</div>

<script>
    // Traffic Chart Config (Sadece Dashboard'da aktif olur)
    const ctx = document.getElementById('trafficChart');
    if (ctx) {
        new Chart(ctx, {
            type: 'line',
            data: {
                labels: ['10:00', '10:05', '10:10', '10:15', '10:20', '10:25'],
                datasets: [{
                    label: 'Network I/O (MB/s)',
                    data: [12, 19, 3, 5, 2, 30],
                    borderColor: '#00d2ff',
                    backgroundColor: 'rgba(0, 210, 255, 0.1)',
                    borderWidth: 2,
                    fill: true,
                    tension: 0.4
                }]
            },
            options: {
                responsive: true,
                plugins: { legend: { display: false } },
                scales: {
                    x: { grid: { color: '#333' } },
                    y: { grid: { color: '#333' } }
                }
            }
        });
    }
</script>
</body>
</html>