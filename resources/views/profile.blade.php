<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Tugas Profile Web Lanjut</title>
    <style>
        body {
            display: flex;
            justify-content: center;
            align-items: center;
            height: 100vh;
            margin: 0;
            font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
            background-color: #f0f2f5;
        }

        .profile-card {
            background-color: #ffffff;
            padding: 40px;
            border-radius: 12px;
            box-shadow: 0 4px 12px rgba(0, 0, 0, 0.1);
            text-align: center;
            width: 100%;
            max-width: 320px;
        }

        .profile-pic {
            width: 150px;
            height: 150px;
            background-color: #e4e6eb;
            border-radius: 50%;
            margin: 0 auto 30px auto;
            border: 4px solid #dcdfe3;
            object-fit: cover;
            display: block;
        }

        .info-box {
            background-color: #e4e6eb;
            color: #1c1e21;
            padding: 12px;
            margin-bottom: 15px;
            border-radius: 6px;
            font-size: 16px;
            font-weight: 500;
        }

        .info-box:last-child {
            margin-bottom: 0;
        }
    </style>
</head>

<body>

    <div class="profile-card">
        <img src="{{ asset('images/pfp.png') }}" alt="Foto Profil" class="profile-pic">

        <div class="info-box">
            {{ $nama }}
        </div>
        <div class="info-box">
            {{ $kelas }}
        </div>
        <div class="info-box">
            {{ $npm }}
        </div>
    </div>

</body>

</html>