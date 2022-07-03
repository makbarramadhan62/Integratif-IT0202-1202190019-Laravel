<!doctype html>
<html lang="en">

<head>
    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <!-- Bootstrap CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet"
        integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">

    <title>MAR.Story_ | {{ $title }}</title>
</head>

<body>

    @include('partials.navbar')
    <div class="container">
        @yield('container')
    </div>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.bundle.min.js"
        integrity="sha384-MrcW6ZMFYlzcLA8Nl+NtUVF0sA7MsXsP1UyJoMp4YLEuNSfAP+JcXn/tWtIaxVXM" crossorigin="anonymous">
    </script>
    <link rel="stylesheet" href="css/style.css">


    <div class="jumbotron text-center">
        <img src="img/profil.jpg" alt="profil" width="200" class="rounded-circle img-thumbnail">
        <h1 class="display-4">Fujita Hisoka</h1>
        <p class="lead">Student Collage | Editor</p>
        <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 1440 320">
            <path fill="#ffffff" fill-opacity="1"
                d="M0,160L30,154.7C60,149,120,139,180,144C240,149,300,171,360,154.7C420,139,480,85,540,80C600,75,660,117,720,133.3C780,149,840,139,900,138.7C960,139,1020,149,1080,165.3C1140,181,1200,203,1260,192C1320,181,1380,139,1410,117.3L1440,96L1440,320L1410,320C1380,320,1320,320,1260,320C1200,320,1140,320,1080,320C1020,320,960,320,900,320C840,320,780,320,720,320C660,320,600,320,540,320C480,320,420,320,360,320C300,320,240,320,180,320C120,320,60,320,30,320L0,320Z">
            </path>
        </svg>
    </div>

    <div class="about">
        <div class="container mb-5">
            <div class="row text-center mb-3">
                <div class="col">
                    <h2>About Me</h2>
                </div>
            </div>
            <div class="row justify-content-center fs-5 text-center">
                <div class="col-5">
                    Lorem ipsum dolor, sit amet consectetur adipisicing elit. Assumenda esse, est dolorem ad nisi
                    facere. Quas quis pariatur magni cumque?
                </div>
                <div class="col-5">
                    Lorem ipsum, dolor sit amet consectetur adipisicing elit. Placeat excepturi quam reprehenderit
                    asperiores, ullam eos exercitationem unde aperiam sunt quaerat necessitatibus hic sint, ea, ad
                    facilis voluptates iure et sit.
                </div>
            </div>
        </div>
        <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 1440 320">
            <path fill="#e2edff" fill-opacity="1"
                d="M0,96L30,117.3C60,139,120,181,180,192C240,203,300,181,360,149.3C420,117,480,75,540,69.3C600,64,660,96,720,122.7C780,149,840,171,900,176C960,181,1020,171,1080,154.7C1140,139,1200,117,1260,117.3C1320,117,1380,139,1410,149.3L1440,160L1440,320L1410,320C1380,320,1320,320,1260,320C1200,320,1140,320,1080,320C1020,320,960,320,900,320C840,320,780,320,720,320C660,320,600,320,540,320C480,320,420,320,360,320C300,320,240,320,180,320C120,320,60,320,30,320L0,320Z">
            </path>
        </svg>
    </div>
</body>

</html>
