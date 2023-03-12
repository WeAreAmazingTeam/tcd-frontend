<!DOCTYPE html>
<html lang="en">
    <head>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <title>404 - The Cloud Donation</title>
        <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/css/bootstrap.min.css" rel="stylesheet">
        <link href="<?= base_url('assets/css/404.css'); ?>" rel="stylesheet">
    </head>
    <body>
        <section class="h-100 w-100" style="box-sizing: border-box; background-color: #1b254e">
            <div class="_404 container mx-auto d-flex align-items-center justify-content-center flex-column" style="font-family: 'Poppins', sans-serif;">
                <img class="main-img img-fluid" src="<?= base_url('assets/img/404.png'); ?>" alt="Image Error 404">
                <div class="text-center w-100">
                    <h1 class="title-text text-white">
                        Opss! Something Missing
                    </h1>
                    <p class="title-caption">
                        The page you’re looking for isn’t found. We<br class="d-sm-block d-none"> suggest you Back to Homepage.
                    </p>
                    <div class="d-flex justify-content-center">
                        <button class="btn btn-back d-inline-flex text-white border-0" onclick="location.href='<?= site_url(); ?>'">
                            Back to Homepage
                        </button>
                    </div>
                </div>
            </div>
        </section>
    </body>
</html>