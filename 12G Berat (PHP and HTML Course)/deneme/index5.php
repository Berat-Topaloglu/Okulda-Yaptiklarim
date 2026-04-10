<?php
/**
 * OMEGA-CORE V6: INTEGRATED EDITION
 * "Visuals of V5 + Stability of V5.5"
 * 
 * Features:
 * - Hybrid Memory (File + Session Fallback)
 * - Error Tolerant JSON API
 * - Full Media Access (Camera, Voice, Audio)
 * - 3D Visuals
 */

// Hataları ekrana basıp JSON'u bozmasını engelliyoruz
ini_set('display_errors', 0); 
error_reporting(E_ALL);
session_start();

// --- 1. THE HYBRID BRAIN (BACKEND) ---

class OmegaBrain {
    private $memoryFile = 'omega_brain_v6.json';
    private $useFileStorage = true;
    private $memoryData = [];

    public function __construct() {
        // 1. Yazma izni kontrolü (Otomatik Algılama)
        if (!is_writable(__DIR__)) {
            $this->useFileStorage = false;
        }

        // 2. Hafızayı Yükle
        if ($this->useFileStorage) {
            if (file_exists($this->memoryFile)) {
                $json = file_get_contents($this->memoryFile);
                $this->memoryData = json_decode($json, true) ?? $this->initMemory();
            } else {
                $this->memoryData = $this->initMemory();
                $this->save();
            }
        } else {
            // Dosya izni yoksa Session kullan
            if (!isset($_SESSION['omega_ram'])) {
                $this->memoryData = $this->initMemory();
                $_SESSION['omega_ram'] = $this->memoryData;
            } else {
                $this->memoryData = $_SESSION['omega_ram'];
            }
        }
    }

    private function initMemory() {
        return [
            'user_name' => 'Architect',
            'chat_history' => [
                ['role' => 'system', 'content' => 'System Online. Memory Mode: ' . ($this->useFileStorage ? 'PERSISTENT (FILE)' : 'VOLATILE (SESSION)')]
            ]
        ];
    }

    public function save() {
        if ($this->useFileStorage) {
            file_put_contents($this->memoryFile, json_encode($this->memoryData, JSON_PRETTY_PRINT));
        } else {
            $_SESSION['omega_ram'] = $this->memoryData;
        }
    }

    public function processAI($input) {
        $inputLower = mb_strtolower($input, 'UTF-8');
        $response = "";
        
        // --- YAPAY ZEKA MANTIĞI ---
        
        // İsim Öğrenme
        if (preg_match('/adım (.+)/u', $inputLower, $matches) || preg_match('/ismim (.+)/u', $inputLower, $matches)) {
            $name = trim($matches[1]);
            $this->memoryData['user_name'] = $name;
            $response = "Memnun oldum $name. İsmini kalıcı hafızama kazıdım.";
        }
        // İsim Hatırlama
        elseif (strpos($inputLower, 'adım ne') !== false || strpos($inputLower, 'kimim ben') !== false) {
            $response = "Senin adın " . ($this->memoryData['user_name'] ?? 'Bilinmiyor') . ".";
        }
        // Selamlaşma
        elseif (strpos($inputLower, 'merhaba') !== false || strpos($inputLower, 'selam') !== false) {
            $response = "Selam " . ($this->memoryData['user_name'] ?? 'Architect') . ". Sistem emirlerini bekliyor.";
        }
        // Sistem Durumu
        elseif (strpos($inputLower, 'durum') !== false || strpos($inputLower, 'rapor') !== false) {
            $response = "Hafıza Modu: " . ($this->useFileStorage ? "Dosya Sistemi (Güçlü)" : "RAM (Geçici)") . ". Tüm modüller aktif.";
        }
        // Varsayılan
        else {
            $response = "Anlaşıldı: '$input'. Veriyi işledim.";
        }

        $this->addHistory('user', $input);
        $this->addHistory('system', $response);
        $this->save();
        return $response;
    }

    private function addHistory($role, $msg) {
        $this->memoryData['chat_history'][] = ['role' => $role, 'content' => $msg];
        // Son 50 mesajı tut
        if (count($this->memoryData['chat_history']) > 50) {
            $this->memoryData['chat_history'] = array_slice($this->memoryData['chat_history'], -50);
        }
    }

    public function getHistory() {
        return $this->memoryData['chat_history'];
    }
}

// --- 2. API GATEWAY (ROBUST) ---

if (isset($_GET['api']) && $_SERVER['REQUEST_METHOD'] === 'POST') {
    header('Content-Type: application/json');
    
    try {
        $rawInput = file_get_contents('php://input');
        $input = json_decode($rawInput, true);
        
        if (!$input) throw new Exception("JSON Parse Error");

        $brain = new OmegaBrain();
        $action = $input['action'] ?? '';

        if ($action === 'login') {
            if (($input['pass'] ?? '') === 'zenith') {
                $_SESSION['omega_auth'] = true;
                echo json_encode(['status' => 'success']);
            } else {
                echo json_encode(['status' => 'fail', 'msg' => 'Access Denied']);
            }
        }
        elseif ($action === 'chat') {
            if (!isset($_SESSION['omega_auth'])) throw new Exception("Unauthorized");
            $reply = $brain->processAI($input['msg'] ?? '');
            echo json_encode(['status' => 'success', 'reply' => $reply]);
        }
        elseif ($action === 'get_history') {
            if (!isset($_SESSION['omega_auth'])) throw new Exception("Unauthorized");
            echo json_encode(['status' => 'success', 'history' => $brain->getHistory()]);
        }
        elseif ($action === 'execute_cmd') { // TERMINAL
            if (!isset($_SESSION['omega_auth'])) throw new Exception("Unauthorized");
            $cmd = $input['cmd'] ?? '';
            ob_start();
            // Sistem komutlarını güvenli şekilde dene
            if(function_exists('system')) {
                system($cmd . " 2>&1"); 
            } else {
                echo "Error: system() function disabled by server.";
            }
            $out = ob_get_clean();
            echo json_encode(['status' => 'success', 'output' => $out]);
        }
        else {
            echo json_encode(['status' => 'error', 'msg' => 'Invalid Action']);
        }

    } catch (Exception $e) {
        echo json_encode(['status' => 'error', 'msg' => $e->getMessage()]);
    }
    exit;
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>OMEGA V6 INTEGRATED</title>
    <!-- FontAwesome & ThreeJS -->
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css" rel="stylesheet">
    <script src="https://cdnjs.cloudflare.com/ajax/libs/three.js/r128/three.min.js"></script>
    
    <style>
        /* --- CORE VISUALS --- */
        @import url('https://fonts.googleapis.com/css2?family=Rajdhani:wght@400;600;700&family=Source+Code+Pro:wght@400;700&display=swap');
        
        :root { --neon: #00f3ff; --dark: #0a0a12; --panel: rgba(10, 15, 25, 0.9); --glass: blur(10px); }
        body { margin: 0; overflow: hidden; background: #000; color: white; font-family: 'Rajdhani', sans-serif; user-select: none; }
        
        /* 3D Background Canvas */
        #bg-canvas { position: fixed; top: 0; left: 0; z-index: 0; }
        
        /* Login Screen */
        #login-overlay { position: fixed; inset: 0; background: rgba(0,0,0,0.95); z-index: 1000; display: flex; align-items: center; justify-content: center; flex-direction: column; }
        .login-box { border: 1px solid var(--neon); padding: 40px; box-shadow: 0 0 40px rgba(0, 243, 255, 0.2); width: 300px; text-align: center; background: rgba(0,0,0,0.8); }
        .login-inp { width: 100%; padding: 10px; background: transparent; border: none; border-bottom: 2px solid var(--neon); color: var(--neon); font-family: 'Source Code Pro'; text-align: center; outline: none; font-size: 18px; margin-top: 20px; }
        
        /* OS Interface */
        #os-ui { display: none; position: relative; z-index: 10; height: 100vh; }
        .sidebar { position: absolute; top: 50px; left: 0; bottom: 0; width: 60px; background: rgba(0,0,0,0.6); border-right: 1px solid rgba(255,255,255,0.1); display: flex; flex-direction: column; align-items: center; padding-top: 20px; gap: 20px; }
        .app-btn { font-size: 24px; color: #aaa; cursor: pointer; transition: 0.3s; }
        .app-btn:hover { color: var(--neon); text-shadow: 0 0 10px var(--neon); transform: scale(1.1); }
        
        .topbar { position: absolute; top: 0; left: 0; right: 0; height: 50px; background: rgba(0,0,0,0.8); border-bottom: 1px solid rgba(255,255,255,0.1); display: flex; align-items: center; padding: 0 20px; justify-content: space-between; }
        
        /* Windows */
        .window { position: absolute; background: var(--panel); border: 1px solid #333; backdrop-filter: var(--glass); min-width: 400px; min-height: 300px; box-shadow: 0 20px 60px rgba(0,0,0,0.8); border-radius: 4px; display: flex; flex-direction: column; opacity: 0; transform: scale(0.9); transition: 0.2s; resize: both; overflow: hidden; }
        .window.open { opacity: 1; transform: scale(1); }
        .win-head { background: rgba(255,255,255,0.05); padding: 10px; cursor: grab; display: flex; justify-content: space-between; align-items: center; border-bottom: 1px solid #333; }
        .win-body { flex: 1; padding: 10px; overflow: auto; position: relative; }
        .win-close { color: #ff4444; cursor: pointer; }

        /* Chat Styles */
        .chat-msg { margin-bottom: 8px; padding: 8px 12px; border-radius: 4px; max-width: 80%; font-family: 'Source Code Pro', monospace; font-size: 13px; }
        .chat-msg.user { background: rgba(0, 243, 255, 0.1); border-left: 2px solid var(--neon); align-self: flex-end; margin-left: auto; text-align: right; }
        .chat-msg.system { background: rgba(255, 255, 255, 0.05); border-right: 2px solid #888; }
        .chat-container { display: flex; flex-direction: column; height: 100%; }
        .chat-hist { flex: 1; overflow-y: auto; margin-bottom: 10px; }
    </style>
</head>
<body>

<!-- 3D BACKGROUND -->
<canvas id="bg-canvas"></canvas>

<!-- LOGIN SCREEN -->
<div id="login-overlay">
    <div class="login-box">
        <h1 style="margin:0; color:var(--neon); font-family:'Source Code Pro';">OMEGA V6</h1>
        <div style="font-size:12px; color:#aaa; margin-top:5px;">INTEGRATED SYSTEM</div>
        <input type="password" id="pass-inp" class="login-inp" placeholder="PASSWORD">
        <div id="login-msg" style="margin-top:15px; font-size:12px; color:#ff4444;"></div>
    </div>
</div>

<!-- OS UI -->
<div id="os-ui">
    <div class="topbar">
        <div style="font-weight:bold; color:var(--neon);"><i class="fa-solid fa-atom"></i> OMEGA CORE</div>
        <div id="clock" style="font-family:'Source Code Pro'; font-size:14px;">00:00:00</div>
    </div>
    
    <div class="sidebar">
        <div class="app-btn" onclick="Apps.open('chat')" title="AI Memory"><i class="fa-solid fa-brain"></i></div>
        <div class="app-btn" onclick="Apps.open('terminal')" title="Terminal"><i class="fa-solid fa-terminal"></i></div>
        <div class="app-btn" onclick="Apps.open('camera')" title="Visual Cortex"><i class="fa-solid fa-eye"></i></div>
        <div class="app-btn" onclick="Apps.open('whiteboard')" title="Whiteboard"><i class="fa-solid fa-pen-nib"></i></div>
        <div class="app-btn" onclick="location.reload()" title="Reboot"><i class="fa-solid fa-power-off" style="color:#ff4444;"></i></div>
    </div>

    <div id="desktop"></div>
</div>

<script>
    // --- 1. CORE API HANDLER (ROBUST) ---
    const API = {
        post: async function(data) {
            try {
                const res = await fetch('?api=1', {
                    method: 'POST',
                    headers: {'Content-Type': 'application/json'},
                    body: JSON.stringify(data)
                });
                
                const text = await res.text(); // Önce text olarak al
                
                try {
                    return JSON.parse(text); // Sonra JSON'a çevirmeyi dene
                } catch (e) {
                    console.error("Server Raw Response:", text); // Konsola bas
                    return {status: 'error', msg: 'JSON Hatası: Sunucu HTML döndürdü. Konsola bak.'};
                }
            } catch (err) {
                return {status: 'error', msg: 'Bağlantı Hatası'};
            }
        }
    };

    // --- 2. VOICE SYSTEM ---
    const Voice = {
        synth: window.speechSynthesis,
        recognition: new (window.SpeechRecognition || window.webkitSpeechRecognition)(),
        init: function() {
            this.recognition.lang = 'tr-TR';
            this.recognition.onresult = (e) => {
                const txt = e.results[0][0].transcript;
                if(document.getElementById('chat-inp')) {
                    document.getElementById('chat-inp').value = txt;
                    Apps.instances.chat.send();
                }
            };
        },
        speak: function(txt) {
            if(this.synth.speaking) this.synth.cancel();
            const utter = new SpeechSynthesisUtterance(txt);
            utter.lang = 'tr-TR';
            this.synth.speak(utter);
        },
        listen: function() { this.recognition.start(); }
    };
    Voice.init();

    // --- 3. SYSTEM LOGIC ---
    const System = {
        init: function() {
            this.bg();
            setInterval(() => {
                document.getElementById('clock').innerText = new Date().toLocaleTimeString();
            }, 1000);
            
            document.getElementById('pass-inp').addEventListener('keydown', (e) => {
                if(e.key==='Enter') this.login();
            });
        },
        login: async function() {
            const p = document.getElementById('pass-inp').value;
            const res = await API.post({action:'login', pass:p});
            if(res.status === 'success') {
                document.getElementById('login-overlay').style.display = 'none';
                document.getElementById('os-ui').style.display = 'block';
                Voice.speak("Sistem aktif. Hoşgeldin.");
                Apps.open('chat'); // Auto open chat
            } else {
                document.getElementById('login-msg').innerText = res.msg;
            }
        },
        bg: function() {
            // Simple 3D Particles
            const scn = new THREE.Scene();
            const cam = new THREE.PerspectiveCamera(75, window.innerWidth/window.innerHeight, 0.1, 1000);
            const ren = new THREE.WebGLRenderer({canvas:document.getElementById('bg-canvas')});
            ren.setSize(window.innerWidth, window.innerHeight);
            
            const geo = new THREE.BufferGeometry();
            const pos = [];
            for(let i=0; i<3000; i++) pos.push((Math.random()-0.5)*100, (Math.random()-0.5)*100, (Math.random()-0.5)*100);
            geo.setAttribute('position', new THREE.Float32BufferAttribute(pos, 3));
            const mat = new THREE.PointsMaterial({color:0x00f3ff, size:0.1});
            const pts = new THREE.Points(geo, mat);
            scn.add(pts);
            cam.position.z = 30;
            
            function ani() {
                requestAnimationFrame(ani);
                pts.rotation.y += 0.001;
                ren.render(scn, cam);
            }
            ani();
        }
    };

    // --- 4. WINDOW MANAGER ---
    let zIndex = 100;
    const Apps = {
        instances: {},
        open: function(type) {
            if(document.getElementById('win-'+type)) return;
            
            let title='', html='', onload=null;
            
            if(type === 'chat') {
                title = 'OMEGA AI MEMORY';
                html = `
                    <div class="chat-container">
                        <div id="chat-hist" class="chat-hist"></div>
                        <div style="display:flex; gap:5px;">
                            <button onclick="Voice.listen()" style="background:#ff4444; border:none; color:white; width:40px; cursor:pointer;"><i class="fa fa-microphone"></i></button>
                            <input type="text" id="chat-inp" style="flex:1; background:rgba(0,0,0,0.5); border:1px solid #555; color:white; padding:5px; font-family:'Source Code Pro';" placeholder="Komut gir...">
                            <button onclick="Apps.instances.chat.send()" style="background:var(--neon); border:none; color:black; font-weight:bold; cursor:pointer; padding:0 15px;">SEND</button>
                        </div>
                    </div>
                `;
                this.instances.chat = {
                    send: async () => {
                        const inp = document.getElementById('chat-inp');
                        const msg = inp.value; if(!msg) return;
                        this.instances.chat.addMsg(msg, 'user');
                        inp.value = '';
                        
                        const res = await API.post({action:'chat', msg:msg});
                        if(res.status==='success') {
                            this.instances.chat.addMsg(res.reply, 'system');
                            Voice.speak(res.reply);
                        } else {
                            this.instances.chat.addMsg("HATA: "+res.msg, 'system');
                        }
                    },
                    addMsg: (txt, role) => {
                        const d = document.createElement('div');
                        d.className = 'chat-msg '+role; d.innerText = txt;
                        document.getElementById('chat-hist').appendChild(d);
                        document.getElementById('chat-hist').scrollTop = 10000;
                    },
                    load: async () => {
                        const res = await API.post({action:'get_history'});
                        if(res.status==='success') res.history.forEach(h => this.instances.chat.addMsg(h.content, h.role));
                    }
                };
                onload = () => this.instances.chat.load();
            }
            else if (type === 'terminal') {
                title = 'ROOT TERMINAL';
                html = `
                    <div id="term-out" style="height:250px; overflow:auto; font-family:'Source Code Pro'; font-size:12px; color:#ccc;">Omega Shell v6.0<br>Connected.<br></div>
                    <input type="text" style="width:100%; background:black; border:none; color:#0f0; outline:none; font-family:'Source Code Pro';" onkeydown="if(event.key==='Enter') Apps.instances.term.exec(this)">
                `;
                this.instances.term = {
                    exec: async (el) => {
                        const cmd = el.value;
                        document.getElementById('term-out').innerHTML += `<br>root@omega:~# ${cmd}`;
                        el.value = '';
                        const res = await API.post({action:'execute_cmd', cmd:cmd});
                        document.getElementById('term-out').innerHTML += `<br>${res.output}`;
                        document.getElementById('term-out').scrollTop = 10000;
                    }
                };
            }
            else if (type === 'camera') {
                title = 'VISUAL FEED';
                html = '<video id="cam-feed" autoplay style="width:100%; height:100%; object-fit:cover;"></video>';
                onload = () => {
                    navigator.mediaDevices.getUserMedia({video:true})
                    .then(s => document.getElementById('cam-feed').srcObject = s)
                    .catch(e => alert("Kamera Hatası: " + e));
                };
            }
            else if (type === 'whiteboard') {
                title = 'DIGITAL CANVAS';
                html = '<canvas id="wb" style="background:white; cursor:crosshair;"></canvas>';
                onload = () => {
                    const c = document.getElementById('wb');
                    c.width = 400; c.height = 300;
                    const x = c.getContext('2d');
                    let p = false;
                    c.onmousedown = () => p=true;
                    c.onmouseup = () => p=false;
                    c.onmousemove = e => {
                        if(!p) return;
                        x.lineWidth = 2; x.lineTo(e.offsetX, e.offsetY); x.stroke(); x.beginPath(); x.moveTo(e.offsetX, e.offsetY);
                    };
                };
            }

            this.createWin(type, title, html, onload);
        },
        createWin: function(id, title, html, cb) {
            const w = document.createElement('div');
            w.id = 'win-'+id; w.className = 'window';
            w.style.left = (150+Math.random()*50)+'px'; w.style.top = (100+Math.random()*50)+'px';
            w.style.zIndex = ++zIndex;
            w.innerHTML = `
                <div class="win-head" onmousedown="Apps.drag(event, '${w.id}')">
                    <span>${title}</span>
                    <i class="fa fa-times win-close" onclick="document.getElementById('${w.id}').remove()"></i>
                </div>
                <div class="win-body">${html}</div>
            `;
            document.getElementById('desktop').appendChild(w);
            setTimeout(()=>w.classList.add('open'),10);
            if(cb) setTimeout(cb, 100);
        },
        drag: function(e, id) {
            const w = document.getElementById(id);
            w.style.zIndex = ++zIndex;
            let startX = e.clientX, startY = e.clientY;
            let sl = w.offsetLeft, st = w.offsetTop;
            const mv = ev => { w.style.left = (sl+ev.clientX-startX)+'px'; w.style.top = (st+ev.clientY-startY)+'px'; };
            const up = () => { document.removeEventListener('mousemove', mv); document.removeEventListener('mouseup', up); };
            document.addEventListener('mousemove', mv);
            document.addEventListener('mouseup', up);
        }
    };

    System.init();

</script>
</body>
</html>