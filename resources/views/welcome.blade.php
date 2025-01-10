<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Omega Point</title>
    <style>

        * {
            box-sizing: border-box;
        }

        body {
            display: flex;
            justify-content: center;
            align-items: center;
            min-height: 100vh;
            margin: 0; /* Remove default body margin */
            background-color: #292929; /* Example background color */
        }

        .container {
            text-align: center;
        }

        /* Add styles for your logo/graphic if needed */
        .logo {
            max-width: 100%; /* Adjust as needed */
            height: auto;
            padding: 15px;
        }
    </style>
</head>
<body>
    <div class="container">
        <svg width="279" height="350" viewBox="0 0 279 350" version="1.1" xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" xml:space="preserve" xmlns:serif="http://www.serif.com/" style="fill-rule:evenodd;clip-rule:evenodd;stroke-linejoin:round;stroke-miterlimit:2;" class="logo">
            <style>
                @keyframes spin {
                    100% { transform: rotateY(180deg) perspective(500vw); }
                }
                #spinner {
                    animation: spin 2s linear infinite;
                    transform-origin: center;
                }
            </style>

            <path d="M139.398,345.283L1.861,70.21L71.148,70.21C71.147,70.323 71.147,70.437 71.147,70.551C71.147,77.384 72.153,83.983 74.025,90.21L34.222,90.21L139.398,300.562L139.398,345.283Z" style="fill:rgb(190,254,3);" id="spinner"/>
            <path d="M139.398,2.299C177.067,2.299 207.649,32.882 207.649,70.551C207.649,108.22 177.067,138.802 139.398,138.802C101.729,138.802 71.147,108.22 71.147,70.551C71.147,32.882 101.729,2.299 139.398,2.299ZM139.398,22.299C112.768,22.299 91.147,43.92 91.147,70.551C91.147,97.181 112.768,118.802 139.398,118.802C166.029,118.802 187.649,97.181 187.649,70.551C187.649,43.92 166.029,22.299 139.398,22.299Z" style="fill:rgb(233,44,168);"/>
            <path d="M139.398,300.562L244.574,90.21L204.771,90.21C206.643,83.983 207.649,77.384 207.649,70.551C207.649,70.437 207.649,70.323 207.649,70.21L276.935,70.21L139.398,345.283L139.398,300.562Z" style="fill:rgb(190,254,3);" id="spinner"/>
        </svg>


    </div>
</body>
</html>
