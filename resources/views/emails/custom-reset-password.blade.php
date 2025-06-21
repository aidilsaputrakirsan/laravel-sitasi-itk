<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Reset Password - SITASI ITK</title>
    <style>
        * {
            margin: 0;
            padding: 0;
            box-sizing: border-box;
        }
        
        body {
            font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
            line-height: 1.6;
            color: #333;
            background-color: #f8f9fa;
        }
        
        .email-container {
            max-width: 600px;
            margin: 0 auto;
            background-color: #ffffff;
            border-radius: 12px;
            box-shadow: 0 4px 6px rgba(0, 0, 0, 0.1);
            overflow: hidden;
        }
        
        .header {
            background: linear-gradient(135deg, #667eea 0%, #764ba2 100%);
            color: white;
            padding: 30px 40px;
            text-align: center;
        }
        
        .header h1 {
            font-size: 28px;
            font-weight: 700;
            margin-bottom: 8px;
        }
        
        .header p {
            font-size: 16px;
            opacity: 0.9;
        }
        
        .content {
            padding: 40px;
        }
        
        .greeting {
            font-size: 24px;
            font-weight: 600;
            color: #2d3748;
            margin-bottom: 20px;
        }
        
        .message {
            font-size: 16px;
            color: #4a5568;
            margin-bottom: 30px;
            line-height: 1.8;
        }
        
        .reset-button {
            text-align: center;
            margin: 40px 0;
        }
        
        .reset-button a {
            display: inline-block;
            background: linear-gradient(135deg, #667eea 0%, #764ba2 100%);
            color: white;
            text-decoration: none;
            padding: 16px 32px;
            border-radius: 8px;
            font-weight: 600;
            font-size: 16px;
            transition: all 0.3s ease;
            box-shadow: 0 4px 15px rgba(102, 126, 234, 0.4);
        }
        
        .reset-button a:hover {
            transform: translateY(-2px);
            box-shadow: 0 6px 20px rgba(102, 126, 234, 0.6);
        }
        
        .security-notice {
            background-color: #fff5f5;
            border-left: 4px solid #fc8181;
            padding: 20px;
            border-radius: 0 8px 8px 0;
            margin: 30px 0;
        }
        
        .security-notice h3 {
            color: #c53030;
            font-size: 18px;
            margin-bottom: 10px;
        }
        
        .security-notice ul {
            color: #742a2a;
            padding-left: 20px;
        }
        
        .security-notice li {
            margin-bottom: 8px;
        }
        
        .alternative-link {
            background-color: #f7fafc;
            padding: 20px;
            border-radius: 8px;
            margin: 30px 0;
            border: 1px solid #e2e8f0;
        }
        
        .alternative-link p {
            font-size: 14px;
            color: #4a5568;
            margin-bottom: 10px;
        }
        
        .alternative-link code {
            background-color: #edf2f7;
            padding: 10px;
            border-radius: 4px;
            display: block;
            word-break: break-all;
            font-size: 12px;
            color: #2d3748;
        }
        
        .user-info {
            background-color: #ebf8ff;
            padding: 20px;
            border-radius: 8px;
            margin: 30px 0;
            border-left: 4px solid #4299e1;
        }
        
        .user-info h3 {
            color: #2b6cb0;
            font-size: 16px;
            margin-bottom: 12px;
        }
        
        .user-info .info-item {
            display: flex;
            justify-content: space-between;
            margin-bottom: 8px;
            font-size: 14px;
        }
        
        .user-info .label {
            font-weight: 600;
            color: #2c5282;
        }
        
        .user-info .value {
            color: #4a5568;
        }
        
        .footer {
            background-color: #2d3748;
            color: white;
            padding: 30px 40px;
            text-align: center;
        }
        
        .footer p {
            margin-bottom: 10px;
            font-size: 14px;
            opacity: 0.8;
        }
        
        .footer .company {
            font-weight: 600;
            font-size: 16px;
            margin-bottom: 5px;
        }
        
        @media (max-width: 600px) {
            .email-container {
                margin: 10px;
                border-radius: 8px;
            }
            
            .header, .content, .footer {
                padding: 20px;
            }
            
            .reset-button a {
                padding: 14px 28px;
                font-size: 15px;
            }
        }
    </style>
</head>
<body>
    <div class="email-container">
        <!-- Header -->
        <div class="header">
            <h1>🔐 SITASI ITK</h1>
            <p>Sistem Informasi Tugas Akhir - Institut Teknologi Kalimantan</p>
        </div>
        
        <!-- Content -->
        <div class="content">
            <div class="greeting">
                Halo, {{ $user->name }}! 👋
            </div>
            
            <div class="message">
                Kami menerima permintaan untuk mereset password akun SITASI ITK Anda. 
                Jika Anda yang melakukan permintaan ini, silakan klik tombol di bawah untuk melanjutkan proses reset password.
            </div>
            
            <!-- Reset Button -->
            <div class="reset-button">
                <a href="{{ $resetUrl }}">
                    🔑 Reset Password Sekarang
                </a>
            </div>
            
            <!-- User Info -->
            <div class="user-info">
                <h3>📋 Informasi Akun</h3>
                <div class="info-item">
                    <span class="label">Nama:</span>
                    <span class="value">{{ $user->name }}</span>
                </div>
                <div class="info-item">
                    <span class="label">Username:</span>
                    <span class="value">{{ $user->username }}</span>
                </div>
                <div class="info-item">
                    <span class="label">Email:</span>
                    <span class="value">{{ $user->email }}</span>
                </div>
                <div class="info-item">
                    <span class="label">Waktu Permintaan:</span>
                    <span class="value">{{ now()->format('d/m/Y H:i:s') }} WIB</span>
                </div>
            </div>
            
            <!-- Security Notice -->
            <div class="security-notice">
                <h3>⚠️ Penting untuk Keamanan</h3>
                <ul>
                    <li>Link reset password ini hanya berlaku selama <strong>60 menit</strong></li>
                    <li>Jangan bagikan link ini kepada siapa pun</li>
                    <li>Jika Anda tidak merasa melakukan permintaan ini, abaikan email ini</li>
                    <li>Untuk keamanan ekstra, segera ganti password setelah login</li>
                </ul>
            </div>
            
            <!-- Alternative Link -->
            <div class="alternative-link">
                <p><strong>Kesulitan mengklik tombol di atas?</strong></p>
                <p>Copy dan paste link berikut ke browser Anda:</p>
                <code>{{ $resetUrl }}</code>
            </div>
        </div>
        
        <!-- Footer -->
        <div class="footer">
            <div class="company">Institut Teknologi Kalimantan</div>
            <p>Jl. Soekarno Hatta KM 15, Karang Joang, Balikpapan, Kalimantan Timur</p>
            <p>&copy; {{ date('Y') }} ITK. Semua hak dilindungi undang-undang.</p>
            <p style="margin-top: 15px; font-size: 12px;">
                📧 Email ini dikirim secara otomatis, mohon tidak membalas email ini.
            </p>
        </div>
    </div>
</body>
</html>