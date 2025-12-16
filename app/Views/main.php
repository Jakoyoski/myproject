<?= $this->include('templates/header') ?>
<section class="py-5 bg-light">
    <div class="container">
        <h2 class="text-center mb-4">Our Vibrant School Life</h2>
        <div id="schoolLifeCarousel" class="carousel slide" data-bs-ride="carousel">
            <div class="carousel-indicators">
                <button type="button" data-bs-target="#schoolLifeCarousel" data-bs-slide-to="0" class="active" aria-current="true" aria-label="Slide 1"></button>
                <button type="button" data-bs-target="#schoolLifeCarousel" data-bs-slide-to="1" aria-label="Slide 2"></button>
                <button type="button" data-bs-target="#schoolLifeCarousel" data-bs-slide-to="2" aria-label="Slide 3"></button>
            </div>
            <div class="carousel-inner">
                <div class="carousel-item active">
                    <img src="<?=base_url("images/image.webp")?>" class="d-block w-100 img-fluid" alt="Students in classroom">
                    <div class="carousel-caption d-none d-md-block">
                        <h5>Engaging Classroom Learning</h5>
                    </div>
                </div>
                <div class="carousel-item">
                    <img src="<?=base_url("images/image.webp")?>" class="d-block w-100 img-fluid" alt="Students playing sports">
                    <div class="carousel-caption d-none d-md-block">
                        <h5>Active Sports Programs</h5>
                    </div>
                </div>
                <div class="carousel-item">
                    <img src="<?=base_url("images/image.webp")?>" class="d-block w-100 img-fluid" alt="Students performing in event">
                    <div class="carousel-caption d-none d-md-block">
                        <h5>Exciting Extracurriculars</h5>
                    </div>
                </div>
            </div>
            <button class="carousel-control-prev" type="button" data-bs-target="#schoolLifeCarousel" data-bs-slide="prev">
                <span class="carousel-control-prev-icon" aria-hidden="true"></span>
                <span class="visually-hidden">Previous</span>
            </button>
            <button class="carousel-control-next" type="button" data-bs-target="#schoolLifeCarousel" data-bs-slide="next">
                <span class="carousel-control-next-icon" aria-hidden="true"></span>
                <span class="visually-hidden">Next</span>
            </button>
        </div>
    </div>
</section>

<section class="hero bg-primary">
        <div class="container-fluid">
            <h1>Welcome to Our School</h1>
            <p>Providing quality education for a brighter future.</p>
            <a href="<?= base_url('enroll') ?>" class="btn btn-primary btn-lg">Enroll Now</a>
        </div>
</section>

    <section class="section-padding">
        <div class="container">
            <div class="row">
                <div class="col-md-4">
                    <h3>Our Mission</h3>
                    <p>To empower the learner with holistic education for self-actualization</p>
                </div>
                <div class="col-md-4">
                    <h3>Our Vision</h3>
                    <p>To become an enviable centre of excellence in education, that fosters graduates able to go forth and enhance humanity through noble service.</p>
                </div>
                <div class="col-md-4">
                    <h3>Our Motto</h3>
                    <p>Excellence in education and service through diligence</p>
                </div>
            </div>
        </div>
    </section>

    <section class="bg-primary text-white section-padding">
        <div class="container-fluid">
            <h2>Upcoming Events</h2>
            <div class="row">
                <div class="col-md-4">
                    <h4>School Sports Day</h4>
                    <p>Date: June 15, 2024</p>
                </div>
                <div class="col-md-4">
                    <h4>Parent-Teacher Meeting</h4>
                    <p>Date: July 20, 2024</p>
                </div>
                <div class="col-md-4">
                    <h4>Parent-Teacher Meeting</h4>
                    <p>Date: July 20, 2024</p>
                </div>
            </div>
        </div>
    </section>
<?= $this->include('templates/footer') ?>