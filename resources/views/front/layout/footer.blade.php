<footer class="bg-dark">
    <div class="container">
        <div class="row">
            <div class="col-md-6 col-lg-3 mb-2-5 mb-lg-0">
                <a href="{{ url('/') }}" class="footer-logo">
                    <img src="{{ asset('front/images/Gaam_Raam_logo.png') }}" class="mb-4" alt="Footer Logo" />
                </a>
                <div class="contact-detaills">
                    <ul>
                        <li><i class="fa-solid fa-location-dot"></i>House No. 81 Village Shimla Moulana Post office Chandoli District Panipat Panipat HARYANA 132103</li>
                        <li><i class="fa-solid fa-phone"></i>9053903100</li>
                        <li><i class="fa-solid fa-envelope"></i>Gaamraam.ngo@gmail.com</li>
                    </ul>
                </div>

                <div class="quform-elements">
                    <div class="row">
                        <div class="col-md-12">
                            <div class=" mb-0">
                                <form action="{{ route('subscriber') }}" method="POST">
                                    @csrf
                                    <div class="quform-input d-flex">
                                        <input class="form-control" id="subscriber-email" type="email" name="email" placeholder="Subscribe with us" />
                                        <button class="btn btn-white text-primary m-0 px-2 footer-bbnt" type="submit">
                                            <i class="fas fa-paper-plane"></i>
                                        </button>
                                    </div>

                                </form>

                            </div>
                        </div>
                    </div>
                </div>

            </div>

            <div class="col-6 col-md-6 col-lg-2 mb-2-5 mb-lg-0">
                <div class="ps-md-1-6 ps-lg-1-9">
                    <h3 class="text-primary h5 mb-2-2">About</h3>
                    <ul class="footer-list">
                        <li><i class="fas fa-info-circle"></i> <a href="{{ url('about') }}">About Us</a></li>
                        <li><i class="fas fa-book-open"></i> <a href="{{ url('course') }}">Courses</a></li>
                        <!-- <li><i class="fas fa-chalkboard-teacher"></i> <a href="{{ url('our-teacher') }}">Our Teacher</a>
                        </li> -->
                        <li><i class="fas fa-envelope"></i> <a href="{{ url('our-college') }}">Our Partners</a></li>
                        <li><i class="fas fa-user-shield"></i> <a href="{{ url('privacy-policy') }}">Privacy Policy</a>
                        </li>
                    </ul>
                </div>
            </div>
            <div class=" col-6 col-md-6 col-lg-3 mb-2-5 mb-md-0">
                <div class="ps-lg-1-9 ps-xl-2-5">
                    <h3 class="text-primary h5 mb-2-2">Link</h3>
                    <ul class="footer-list">
                        <!-- <li><i class="fas fa-newspaper"></i> <a href="{{ url('blog') }}">Blogs</a></li> -->
                        <!-- <li><i class="fas fa-user-graduate"></i> <a href="{{ url('student-review') }}">Student
                                Review</a></li> -->
                        <li><i class="fas fa-question-circle"></i> <a href=" {{ url('faq') }}">FAQ</a></li>
                        <li><i class="fas fa-university"></i> <a href="{{ url('contact') }}">Contact</a></li>
                        <li><i class="fas fa-file-contract"></i> <a href="{{ url('term-condition') }}">Term &
                                Condition</a></li>
                    </ul>
                </div>
            </div>

            @php $courses = \App\Models\Course::where('status','1')->get(); @endphp
            <div class="col-md-6 col-lg-4">
                <div class="ps-md-1-9">
                    <h3 class="text-primary h5 mb-2-2">Our Courses</h3>
                    @if (isset($courses) && !empty($courses))
                    @foreach ($courses as $course)
                    <div class="gap-2 media footer-border">
                        <img class="border-radius-5" style="max-width: 30%;height: 73px;vertical-align: top; object-fit:cover;"
                            src="{{ asset($course->image) }}" alt="{{ asset($course->image) }}">
                        <div class="media-body align-self-center">
                            <h4 class="h6 mb-2"><a href="{{ route('course-detail', $course->slug) }}"
                                    class="text-white text-primary-hover">{{ $course->name ?? '' }}</a></h4>
                        </div>
                    </div>
                    @endforeach
                    @endif
                </div>
            </div>
        </div>
        <div class="footer-bar text-center">
            <p class="mb-0 text-white font-weight-500">
                {{ date('Y') }} © All Rights Reserved By <i class="fa fa-heart heart text-danger"></i>
                <a href="{{ url('/') }}" target="_blank" class="text-secondary">Gaam Raam Trust</a> And Powered By
                <a href="{{ url('https://www.pearlorganisation.com/') }}" target="_blank" class="text-secondary">Pearl
                    Organisation</a>
            </p>
        </div>
    </div>
</footer>