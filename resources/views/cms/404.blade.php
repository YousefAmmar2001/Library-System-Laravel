<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>404 | Page Not Found</title>
    <link rel="stylesheet" href="{{ asset('cms/plugins/fontawesome-free/css/all.min.css') }}">
    <link rel="stylesheet" href="{{ asset('cms/dist/css/adminlte.min.css') }}">
    <style>
        body {
            background: linear-gradient(135deg, #1a2a3a 0%, #1e3a5f 50%, #1565a8 100%);
            min-height: 100vh;
            display: flex;
            align-items: center;
            justify-content: center;
            font-family: 'Arial', sans-serif;
            overflow: hidden;
        }

        .error-container {
            text-align: center;
            color: white;
            padding: 40px;
            position: relative;
            z-index: 2;
        }

        .error-number {
            font-size: 180px;
            font-weight: 900;
            line-height: 1;
            background: linear-gradient(135deg, #3498db 0%, #007bff 100%);
            -webkit-background-clip: text;
            -webkit-text-fill-color: transparent;
            background-clip: text;
            margin-bottom: 0;
            animation: pulse 2s infinite;
        }

        @keyframes pulse {
            0%, 100% { opacity: 1; transform: scale(1); }
            50% { opacity: 0.85; transform: scale(1.02); }
        }

        .error-icon {
            font-size: 60px;
            margin: 10px 0;
            color: #3498db;
            animation: float 3s ease-in-out infinite;
        }

        @keyframes float {
            0%, 100% { transform: translateY(0px); }
            50% { transform: translateY(-15px); }
        }

        .error-title {
            font-size: 32px;
            font-weight: 700;
            margin: 15px 0 10px;
            color: #ffffff;
        }

        .error-subtitle {
            font-size: 16px;
            color: #a8c6e8;
            margin-bottom: 40px;
            max-width: 400px;
            margin-left: auto;
            margin-right: auto;
        }

        .buttons-wrapper {
            display: flex;
            gap: 16px;
            justify-content: center;
            flex-wrap: wrap;
        }

        .btn-login {
            display: inline-block;
            padding: 14px 32px;
            color: white;
            text-decoration: none;
            border-radius: 50px;
            font-size: 15px;
            font-weight: 600;
            transition: all 0.3s ease;
        }

        .btn-login:hover {
            color: white;
            text-decoration: none;
            transform: translateY(-3px);
        }

        .btn-admin {
            background: linear-gradient(135deg, #1a6fc4 0%, #007bff 100%);
            box-shadow: 0 10px 30px rgba(0, 123, 255, 0.4);
        }

        .btn-admin:hover {
            box-shadow: 0 15px 40px rgba(0, 123, 255, 0.6);
        }

        .btn-user {
            background: linear-gradient(135deg, #117a8b 0%, #17a2b8 100%);
            box-shadow: 0 10px 30px rgba(23, 162, 184, 0.4);
        }

        .btn-user:hover {
            box-shadow: 0 15px 40px rgba(23, 162, 184, 0.6);
        }

        .btn-login i {
            margin-right: 8px;
        }

        /* Floating circles background */
        .circles {
            position: fixed;
            top: 0; left: 0;
            width: 100%; height: 100%;
            overflow: hidden;
            z-index: 1;
        }

        .circles li {
            position: absolute;
            display: block;
            list-style: none;
            width: 20px; height: 20px;
            background: rgba(0, 123, 255, 0.12);
            border-radius: 50%;
            animation: rise 15s infinite;
            bottom: -150px;
        }

        .circles li:nth-child(1)  { left: 25%;  width: 80px;  height: 80px;  animation-delay: 0s;  animation-duration: 12s; }
        .circles li:nth-child(2)  { left: 10%;  width: 20px;  height: 20px;  animation-delay: 2s;  animation-duration: 10s; }
        .circles li:nth-child(3)  { left: 70%;  width: 20px;  height: 20px;  animation-delay: 4s;  animation-duration: 14s; }
        .circles li:nth-child(4)  { left: 40%;  width: 60px;  height: 60px;  animation-delay: 0s;  animation-duration: 18s; }
        .circles li:nth-child(5)  { left: 65%;  width: 20px;  height: 20px;  animation-delay: 0s;  animation-duration: 11s; }
        .circles li:nth-child(6)  { left: 75%;  width: 110px; height: 110px; animation-delay: 3s;  animation-duration: 15s; }
        .circles li:nth-child(7)  { left: 35%;  width: 150px; height: 150px; animation-delay: 7s;  animation-duration: 20s; }
        .circles li:nth-child(8)  { left: 50%;  width: 25px;  height: 25px;  animation-delay: 15s; animation-duration: 25s; }
        .circles li:nth-child(9)  { left: 20%;  width: 15px;  height: 15px;  animation-delay: 2s;  animation-duration: 13s; }
        .circles li:nth-child(10) { left: 85%;  width: 150px; height: 150px; animation-delay: 0s;  animation-duration: 17s; }

        @keyframes rise {
            0%   { bottom: -150px; transform: translateX(0) rotate(0deg);    opacity: 1; border-radius: 50%; }
            100% { bottom: 110%;   transform: translateX(200px) rotate(720deg); opacity: 0; border-radius: 50%; }
        }
    </style>
</head>
<body>

    <ul class="circles">
        <li></li><li></li><li></li><li></li><li></li>
        <li></li><li></li><li></li><li></li><li></li>
    </ul>

    <div class="error-container">
        <div class="error-number">404</div>
        <div class="error-icon">
            <i class="fas fa-map-signs"></i>
        </div>
        <h1 class="error-title">Page Not Found</h1>
        <p class="error-subtitle">
            The page you're looking for doesn't exist or has been moved.
        </p>
        <div class="buttons-wrapper">
            <a href="{{ route('cms.login', 'admin') }}" class="btn-login btn-admin">
                <i class="fas fa-user-shield"></i> Admin Login
            </a>
            <a href="{{ route('cms.login', 'user') }}" class="btn-login btn-user">
                <i class="fas fa-user"></i> User Login
            </a>
        </div>
    </div>

</body>
</html>