<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Error 404 - Halaman Tidak Ditemukan</title>

    <!-- Import Poppins font -->
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@400;600;700&display=swap" rel="stylesheet">

    <style>
        /* Body styling */
        body {
            font-family: 'Poppins', sans-serif;
            background: linear-gradient(135deg, #2a9d8f, #264653);
            /* Green gradient */
            color: #fff;
            margin: 0;
            height: 100vh;
            display: flex;
            justify-content: center;
            align-items: center;
            text-align: center;
        }

        /* Main container for the 404 message */
        .container {
            background: rgba(13, 110, 253, 0.9);
            padding: 50px;
            border-radius: 12px;
            box-shadow: 0 12px 40px rgba(13, 27, 42, 0.25);
            width: 80%;
            max-width: 500px;
            transition: transform 0.3s ease-in-out;
        }

        .container:hover {
            transform: scale(1.05);
        }

        /* Heading styling */
        h1 {
            font-size: 72px;
            font-weight: 700;
            margin: 0;
            color: #ff7eb3;
            /* Pink color */
        }

        h2 {
            font-size: 24px;
            margin-top: 15px;
            font-weight: 600;
            color: #e76f51;
            /* Accent color */
        }

        /* Paragraph styling */
        p {
            font-size: 18px;
            margin-top: 15px;
            color: #f1faee;
        }

        /* Button styling */
        .btn {
            display: inline-block;
            padding: 12px 24px;
            margin-top: 20px;
            background-color: #264653;
            /* Dark green */
            color: white;
            text-decoration: none;
            font-size: 16px;
            border-radius: 30px;
            transition: background-color 0.3s ease;
            font-weight: 600;
        }

        .btn:hover {
            background-color: #e76f51;
            /* Accent color on hover */
        }

        /* Fade-in effect */
        .fade-in {
            opacity: 0;
            animation: fadeIn 1.5s forwards;
        }

        @keyframes fadeIn {
            0% {
                opacity: 0;
                transform: translateY(30px);
            }

            100% {
                opacity: 1;
                transform: translateY(0);
            }
        }

        /* Link style for "Back to Home" */
        .home-link {
            margin-top: 20px;
            display: inline-block;
            font-size: 16px;
            color: #0d6efd;
            text-decoration: none;
            font-weight: 600;
        }

        .home-link:hover {
            text-decoration: underline;
        }
    </style>
</head>

<body>
    <div class="container fade-in">
        <h1>404</h1>
        <h2>Halaman Tidak Ditemukan</h2>
        <p>Maaf, halaman yang Anda cari tidak ada atau sudah dihapus.</p>
        <a href="/" class="btn">Kembali ke Beranda</a>
    </div>
</body>

</html>