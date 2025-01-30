@extends('frontend.main')
@section('content')

@section('meta')
    <?php
    $pageTitle = 'Experienced Mental Health Therapist & Psychologist Near You | Online Counseling Services';
    $pageDescription = 'Find expert mental health therapy and counseling services near you. Connect with a qualified psychologist for personalized online counseling sessions to address your mental health needs effectively.';

    switch ($slug) {
        case 'anger':
            $pageTitle = 'Anger Management | Anger Management Techniques | EDHA';
            $pageDescription = 'EDHA offers counseling services specifically designed to help individuals manage and reduce anger. We helps individuals understand the root causes of their anger and develop healthier responses.';
            break;
        case 'stress-anxiety-depression':
            $pageTitle = 'Online Counsellor for Depression & Anxiety | Stress Management';
            $pageDescription = 'Discover expert solutions for stress management and anxiety treatment with online counseling for depression. Get personalized support from qualified counselors. Start your journey towards inner peace today.';
            break;
        case 'relationship':
            $pageTitle = 'Relationship Issues Counseling | Counseling for Toxic Relationship';
            $pageDescription = 'If you&#39;re seeking counseling for relationship issues or dealing with a toxic relationship, EDHA provides professional guidance and support to help individuals navigate these challenging situations.';
            break;
        case 'marriage':
            $pageTitle = 'Marriage Counseling | Isolation | EDHA';
            $pageDescription = 'EDHA offers comprehensive marriage counseling to help couples address issues of isolation and disconnection, which can strain their relationship.';
            break;
        case 'trauma':
            $pageTitle = 'Overcoming Fear | Overcoming Phobia | EDHA';
            $pageDescription = 'EDHA offers expert counseling services for individuals looking to overcome fear and phobias. Fear and phobias can deeply affect a person’s quality of life, limiting activities and causing anxiety.';
            break;
        case 'motherhood-challenges':
            $pageTitle = 'Counseling for Postpartum Depression| EDHA';
            $pageDescription = 'EDHA provides specialized counseling services for individuals experiencing postpartum depression, a condition that can affect new parents, particularly mothers, after childbirth.';
            break;
        case 'lifestyle-issues':
            $pageTitle = 'Mid Life Crisis | Sexual Wellness| EDHA';
            $pageDescription = 'EDHA provides expert counseling for individuals navigating a mid-life crisis, particularly those experiencing challenges related to sexual wellness.';
            break;
        case 'parenting':
            $pageTitle = 'Separation Anxiety | Single Parents | EDHA';
            $pageDescription = 'EDHA offers specialized counseling for individuals dealing with separation anxiety, particularly for single parents facing the emotional challenges of being apart from their children.';
            break;
        case 'child-adolescent':
            $pageTitle = 'Identity Crisis | ADHD | Bullying | EDHA';
            $pageDescription = 'EDHA offers specialized counseling for children and adolescents facing challenges like identity crisis, ADHD, and the effects of bullying.';
            break;
        case 'obsessive-compulsive-disorder':
            $pageTitle = 'Understanding Obsessive-Compulsive Disorder: Symptoms, Causes & Treatment';
            $pageDescription = 'Dive into the complexities of Obsessive-Compulsive Disorder (OCD), exploring its symptoms, causes, and effective treatment options. Get comprehensive insights here.';
            break;
        case 'counselling':
            $pageTitle = 'Career Counseling | Depression Counseling | EDHA';
            $pageDescription = 'EDHA provides expert career counseling and depression counseling to individuals seeking guidance in navigating their professional life and emotional well-being.';
            break;
        case 'counselling':
            $pageTitle = 'Career Counseling | Depression Counseling | EDHA';
            $pageDescription = 'EDHA provides expert career counseling and depression counseling to individuals seeking guidance in navigating their professional life and emotional well-being.';
            break;
    }

    echo "<meta name='title' content='$pageTitle'>";
    echo "<title>$pageTitle</title>";
    echo "<meta name='description' content='$pageDescription'>";
    ?>
@endsection
<style>
    .counsellingsection a {
        color: #f67c33;
    }

    .full-size-image {
        width: 100%;
        position: relative;
        display: flex;
        justify-content: start;
        align-items: start;
    }

    .full-size-image {
        width: 100%;
        position: relative;
        display: flex;
        justify-content: start;
        align-items: start;
    }

    .full-size-image img {
        width: 100%;
        height: 500px;
    }

    .image-title {
        position: absolute;
        color: white;
        padding: 10px;
        top: 80px;
        left: 40px;
        margin: 0px 48px;
    }

    .btn-all span {
        color: white;
        /* display: inline-block; */
        /* margin-top: 20px;
            width: auto; */

    }

    .quotes {
        padding-top: 60px;
    }

    .image-title h1 {
        font-size: 3rem;
    }

    .image-title p {
        font-size: 18px;
    }

    .contact-us {
        position: fixed;
        right: -15px;
        bottom: 40%;
        transform: rotate(90deg);
        z-index: 1000;
    }

    @media only screen and (max-width: 786px) {
        .full-size-image {
            display: block;
            text-align: center;
        }

        .full-size-image img {
            height: auto;
        }

        .image-title {
            position: static;
            padding: 20px;
            margin: 0;
            text-align: center;
        }

        .quotes {
            padding-top: 1px;
        }

        .image-title h1 {
            font-size: 2rem;
            color: #f67c33;
        }

        .image-title p {
            color: black;
            font-size: 16px;

        }

        .btn-all span {
            color: black;
            display: inline-block;
            /* margin-top: 20px; */
            width: auto;

        }

    }
</style>
@foreach ($items as $item)
    <section class="container-fluid">
        <div class="full-size-image">
            <img src="{{ url('public/assets/img/' . $item['image']) }}" alt="{{ $item['title'] }}">
            <div class="image-title">
                <h1>{{ $item['title'] }}</h1>
                <div class="quotes">
                    <p>{!! $item['quotes'] !!}</p>
                </div>
                <div class="row aos-init aos-animate" data-aos="fade-up">
                    <div class="col-md-12">
                        <div class="w-100">
                            <a href="{{ url('find-expert') }}"
                                class="btn btn-outline-warning  btn-all  position-relative px-md-5 rounded-pill">
                                <span class="" style="font-size: 20px;">
                                    Talk to a Therapist Online
                                </span>
                                <span class="btnicon">
                                    ⟶
                                </span>
                            </a>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="contact-us">
            <button type="button" class="btn btn-warning" data-bs-toggle="modal" data-bs-target="#ContactUsModal">
                <span style="font-size: 20px;">Contact Us</span>
            </button>
        </div>
        <!-- Contact Us Modal -->
        <div class="modal fade" id="ContactUsModal" tabindex="-1" role="dialog" aria-labelledby="ContactUsModalLabel"
            aria-hidden="true">
            <div class="modal-dialog modal-dialog-centered">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title" id="ContactUsModalLabel">Contact Us</h5>
                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                    </div>
                    <div class="modal-body">
                        <form method="post" action="{{ route('contactForm') }}">
                            @csrf
                            <div class="form-group">
                                <label for="name">Name</label>
                                <input type="text" class="form-control" id="name" required>
                            </div>
                            <div class="form-group">
                                <label for="mobile">Mobile</label>
                                <input type="text" class="form-control" id="mobile" required>
                            </div>
                            <div class="form-group">
                                <label for="message">Message</label>
                                <textarea class="form-control" id="message" rows="3" required></textarea>
                            </div>
                            <div class="text-center my-3">
                                <button type="submit" class="btn btn-primary">Submit</button>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </section>
    <section class="space counsellingsection" id="{{ $item['url'] }}">
        <div class="container">
            <div class="row ">
                <div class="col-md-12">
                    <div class="w-100">
                        {!! $item['description'] !!}
                    </div>
                </div>
            </div>
            @if ($item['key_points'])
                <div class="row keypoint align-items-center" id="">
                    <div class="col-md-6">
                        <div class="w-100">
                            {!! $item['key_points'] !!}
                        </div>
                    </div>
                    <!--<div class="col-md-6">-->
                    <!--    <div class="w-100 imgbox">-->
                    <!--        <img src="{{ url('public/assets/img/' . $item['image']) }}" alt="anger management therapy"-->
                    <!--            class="img-fluid rounded-4">-->
                    <!--    </div>-->
                    <!--</div>-->
                </div>
            @endif
            <!--<div class="row mt-3 aos-init aos-animate" data-aos="fade-up">-->
            <!--    <div class="col-md-12">-->
            <!--        <div class="w-100 text-start">-->
            <!--            <a href="{{ url('find-expert') }}"-->
            <!--                class="btn btn-outline-warning  btn-all  position-relative px-md-5 rounded-pill">-->
            <!--                <span class="text-primary">-->
            <!--                    Book an Appointment-->
            <!--                </span>-->
            <!--                <span class="btnicon text-white">-->
            <!--                    ⟶-->
            <!--                </span>-->
            <!--            </a>-->
            <!--        </div>-->
            <!--    </div>-->
            <!--</div>-->
        </div>
    </section>
@endforeach
@endsection
