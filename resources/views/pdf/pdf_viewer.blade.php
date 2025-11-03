
<!DOCTYPE html>
<html lang="uz">

<head>
    <meta charset="utf-8">
    <meta content="width=device-width, initial-scale=1.0" name="viewport">

    <!-- CSRF Token -->
    <meta name="csrf-token" content="VQXPXdlXPzWeBGL2DUOyWbj011syr2jZsGLuzcyT">

    <title></title>
    <meta content="" name="description">
    <meta content="" name="keywords">


       <!-- Favicons -->
       <link rel="apple-touch-icon" sizes="180x180" href="/favicon/apple-touch-icon.png">
    <link rel="icon" type="image/png" sizes="32x32" href="/favicon/favicon-32x32.png">
    <link rel="icon" type="image/png" sizes="16x16" href="/favicon/favicon-16x16.png">
    <link rel="manifest" href="/favicon/site.webmanifest">
    <link rel="mask-icon" href="/favicon/safari-pinned-tab.svg" color="#5bbad5">
    <meta name="msapplication-TileColor" content="#da532c">
    <meta name="theme-color" content="#ffffff">

    <!-- Google Fonts -->
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Roboto:wght@400;500;700&display=swap" rel="stylesheet">
</head>

<body>


<main id="main">

    <div class="solid-container" style="height: 100vh;"></div>

</main>

<!-- Vendor JS Files -->
<script src="https://baburid.uz/assets/vendor/jquery/jquery.min.js"></script>

    <script src="https://baburid.uz/assets/js/html2canvas.min.js"></script>
    <script src="https://baburid.uz/assets/js/three.min.js"></script>
    <script src="https://baburid.uz/assets/js/pdf.min.js"></script>
    <script type="text/javascript">
        window.PDFJS_LOCALE = {
            pdfJsWorker: '/assets/js/pdf.worker.js',
            pdfJsCMapUrl: 'cmaps'
        };
    </script>
    <script src="https://baburid.uz/assets/js/3d-flip-book.min.js"></script>
    <!-- Template Main JS File -->

    <script type="text/javascript">
        $(document).ready(function() {
            console.log( "ready!" );
            var options = {
                pdf: '{{ $book->getFile() }}',
                controlsProps: {
                    actions: {
                        cmdPrint: {
                            enabled: true,
                        },
                        cmdSinglePage: {
                            active: true,
                            enabled: true,
                            activeForMobile: true,
                        },
                    },
                    loadingAnimation: {
                        book: false
                    },
                    autoResolution: {
                        enabled: false
                    },
                    scale: {
                        max: 4
                    }
                },
                template: { // by means this property you can choose appropriate skin
                    html: '/assets/default-book-view.html',
                    styles: [
                        '/assets/css/black-book-view.css'// or one of white-book-view.css, short-white-book-view.css, shart-black-book-view.css
                    ],
                    links: [{
                        rel: 'stylesheet',
                        href: '/assets/css/font-awesome.min.css'
                    }],
                    script: '/assets/js/default-book-view.js',
                    printStyle: undefined, // or you can set your stylesheet for printing ('print-style.css')
                    sounds: {
                        startFlip: '/assets/sounds/start-flip.mp3',
                        endFlip: '/assets/sounds/end-flip.mp3'
                    }
                },
            };
            $('.solid-container').FlipBook(options);
        });

    </script>

    <script>
        document.addEventListener("contextmenu", function(event) {
            event.preventDefault(); // Disable right-click
        });

        document.addEventListener("keydown", function(event) {
            if (event.key === "F12" ||
                (event.ctrlKey && event.shiftKey && event.key === "I") ||
                (event.ctrlKey && event.shiftKey && event.key === "J") ||
                (event.ctrlKey && event.key === "U")) {
                event.preventDefault();
            }
        });
    </script>


</body>

</html>
