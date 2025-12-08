<!DOCTYPE html>
<html>
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <title>List  data Akademik</title>
        <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.8/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-sRIl4kxILFvY47J16cr9ZwB07vP4J8+LH7qKQnuqkuIAvNWLzeN8tE5YBujZqJLB" crossorigin="anonymous">

        <style>
        body {
            background-image: url('https://wallpapercave.com/wp/wp15041309.webp');
            background-size: cover;        
            background-repeat: no-repeat; 
            background-position: center;   
            background-attachment: fixed;  
        }

        .container {
            max-width: 1200px;
            backdrop-filter: blur(1px);
            -webkit-backdrop-filter: blur(1px);
            padding: 25px;
            border-radius: 50px;
            box-shadow: 7px 7px 15px 7px rgba(0, 0, 0, 0.54);
            overflow: hidden;
            margin-top: 40px;   /* gedein buat nurunin */
            padding-top: 20px;  /* kecilin biar h1 ga kejauhan */
        }

        h2 {
            font-weight: 600;
            margin-bottom: 20px;
            color: #333;
        }

        .form-control {
            border-radius: 10px;
            padding: 10px 12px;
        }

        .btn-primary {
            padding: 10px 20px;
            border-radius: 10px;
        }

        .btn-secondary {
            padding: 10px 20px;
            border-radius: 10px;
            margin-left: 5px;
        }

        table {
            width: 100%;
            border-collapse: collapse;
            table-layout: fixed;
        }
        .fade-page {
            opacity: 0;
            transform: translateY(20px);
            transition: opacity .4s ease, transform .4s ease;
        }

        .fade-page.show {
            opacity: 1;
            transform: translateY(0);
        }



    </style>
    </head>
    <body class="fade-page">
        <nav class="navbar navbar-expand-lg "style="background: transparent; backdrop-filter: blur(1px);">
        <div class="container">
            <a class="navbar-brand" style="color: white" href="#">
            <img src="https://wallpapercave.com/wp/wp7471372.jpg" alt="Barca" 
                 style="height:35px; width:auto; margin-right:10px;border-radius: 30px">
            Akademik
        </a>

            <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNavAltMarkup" aria-controls="navbarNavAltMarkup" aria-expanded="false" aria-label="Toggle navigation">
            <span class="navbar-toggler-icon"></span>
            </button>
            <div class="collapse navbar-collapse" id="navbarNavAltMarkup">
            <div class="navbar-nav">
                <a class="nav-link active" style="color: #ffff;" aria-current="page" href="index.php?page=home">Home</a>
                <a class="nav-link" style="color: #ffff;" href="index.php?page=datamahasiswa">Data Mahasiswa</a>
                <a class="nav-link" style="color: #ffff;" href="index.php">Data Akademik</a>
            </div>
            </div>
        </div>
        </nav>
        </div>

        <div class="container my-4">
            <?php
            $page = isset($_GET['page']) ? $_GET['page'] : 'home';
            
            if($page == 'home') include 'home.php';
            if($page == 'datamahasiswa') include 'list.php';
            if($page == 'create') include 'create.php';
            if($page == 'edit') include 'edit.php';
        ?>
        </div>

        <script>
            document.addEventListener("DOMContentLoaded", () => {
                
                // efek masuk (fade in)
                setTimeout(() => {
                    document.body.classList.add("show");
                }, 50);

                // semua link nav dikasi efek keluar
                const links = document.querySelectorAll("a.nav-link");

                links.forEach(link => {
                    link.addEventListener("click", function(e) {
                        e.preventDefault();

                        const url = this.href;

                        // efek keluar (fade out)
                        document.body.classList.remove("show");

                        setTimeout(() => {
                            window.location.href = url;
                        }, 400); // Wajib sama kayak transition di CSS
                    });
                });
            });
            </script>



    </body>
</html>