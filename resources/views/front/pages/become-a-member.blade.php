@extends('front.layout.app')

@section('content')


<section class="pb-4 py-5">
    <div class="container">
        <div class="row">
            <div class="member-section top-member-div text-center">
                <p> Join GaamRaam Trust: Empower Students, Strengthen Communities, and Shape Haryana’s Tomorrow!</p>
                <h4>A Haryana Where No One Stands Alone </h4>
            </div>
        </div>
        <div class="row align-items-baseline">
            <div class="col-lg-7">
                <div class="content-div">
                    <p>As its firstborns, we must end the cycle of struggle and isolation—building a future where no one
                        stands alone. Too many have suffered in silence, risen alone, and felt no obligation to give back—
                        because when they needed support, society turned its back.</p>
                    <p>This ends with us.</p>
                    <p>Alone, we are weak. United, we are unstoppable.</p>
                    <p>What we endured should not be the fate of the next generation. We must rise above caste, religion,
                        and personal barriers to build a future where no one is left behind. We are not just demanding
                        change—we are leading it. Every step we take today lays the foundation for a stronger, wiser, and
                        more united Haryana.</p>
                    <h6 class="py-3">This is more than duty—it is our legacy. Together, we rise. Together, we transform.</h6>
                    <h6> <a href="{{url('member-register')}}" class="register-btn">Start Your Impact Today!</a></h6>
                </div>
            </div>
            <div class="col-lg-5">
                <div class="image-hover course-imagee">
                    <img src="../public/front/images/memimg.jpg" alt="Membership Image">
                </div>
            </div>
        </div>
    </div>
</section>
<!-- topsection -->

<section class="py-5 bg-very-light-gray">
    <div class="container">
        <h2 class="text-center h1 my-3">Be the Change – Choose Your Role</h2>
        <div class="custom-tabs">
            <div class="custom-tab active" data-tab="tab1">Local Member</div>
            <div class="custom-tab" data-tab="tab2">Global Member</div>
        </div>
        <div class="custom-tab-content active" id="tab1">
            <h5 class="text-center">Be the Change in Your Community</h5>
            <p class="text-center">Opportunities aren’t equal for everyone—but together, we can change that.</p>
            <ul>
                <li>Membership Fee: ₹100—A small contribution, a big impact.</li>
                <li>On-Ground Action: Be the force of change—participate in social initiatives, awareness drives, and community programs.</li>
                <li>Volunteer Leadership: Lead teams, organize events, and make a real impact where it’s needed most.</li>
                <li>Social Media Engagement: Use your voice to amplify causes, mobilize support, and inspire action.</li>
            </ul>
        </div>
        <div class="custom-tab-content" id="tab2">
            <h5 class="text-center">Stay Connected to Your Roots, Create Impact</h5>
            <p class="text-center">“You know what it means to be far from home—the struggles, the sacrifices. Now, you have the power to ensure no child in your village has to leave just to survive.”</p>
            <ul>
                <li>Membership Fee: Just one hour’s earnings per month—turn your success into someone’s chance.</li>
                <li>Digital Advocacy: Use your reach to spread awareness, inspire action, and bring people together.</li>
                <li>Global Outreach: Connect with changemakers worldwide and expand the mission beyond borders.</li>
                <li>Strategic Support: Mentor, fund, or network—because real change knows no boundaries.</li>
            </ul>
        </div>

      
    </div>
</section>



<!-- Why Become a Member -->
<section class="why-member bg-very-light-gray">
    <div class="container">
        <h3>Why Become a Member?</h3>
        <p>Being a member unlocks a world of opportunities. From learning to networking, we ensure you gain the best experience possible.</p>

        <div class="row">
            <div class="col-lg-6">
                <div class="become-member-points">
                    <ul>
                        <li>✔ Create Future Leaders – Your support empowers bright students to serve the nation.</li>
                        <li>✔ 100% Transparency & Accountability – Every rupee you contribute is trackable in real time.</li>
                        <li>✔ Your Contribution = Your Influence – Earn Social Points that give you real decision-making power.</li>

                    </ul>
                </div>
            </div>
            <div class="col-lg-6">
                <div class="become-member-points">
                    <ul>
                        <li>✔ Exclusive Benefits for Top Contributors – Special access to key events, leadership roles & priority seating.</li>
                        <li>✔ Rise to the Top – Become a Leader in GaamRaam!
                            <ul>
                                <li> Your Social Points determine your rank, influence, and voting power.</li>
                                <li>The path to leadership is 100% transparent—your impact speaks for itself.</li>
                            </ul>
                        </li>
                        <li><a href="{{url('member-register')}}" class="">Start Your Impact Today! (Become a Changemaker!)</a></li>
                    </ul>
                </div>
            </div>
        </div>
        <a href="{{url('member-register')}}" class="register-btn">Join Now</a>
    </div>
</section>
<!-- Advantages Section -->
<!-- <section class="advantages ">
    <div class="container advan-div">
        <h3>Membership Advantages</h3>
        <div class="row">
            <div class="col-md-4">
                <div class="advantage-box">
                    <h5>Exclusive Discounts</h5>
                    <p>Get special discounts on our services and products.</p>
                </div>
            </div>
            <div class="col-md-4">
                <div class="advantage-box">
                    <h5>Premium Content</h5>
                    <p>Access high-quality content and expert guidance.</p>
                </div>
            </div>
            <div class="col-md-4">
                <div class="advantage-box">
                    <h5>Networking</h5>
                    <p>Connect with professionals and like-minded members.</p>
                </div>
            </div>
        </div>
    </div>
</section> -->

<!-- how to join -->

<section class="py-5">
    <div class="container">
        <div class="row">
            <div class="how-to-join">
                <h2 class="text-center mb-3">How to join ?</h2>
                <h6>₹100/month = A Student’s Future!</h6>
                <p>Your support funds free UPSC & SSC coaching, providing mentorship and guidance to students who need it the most.</p>
                <span>3 Easy Steps to Join!</span>
                <ul>
                    <li>✔ Step 1: Sign Up – Fill out the quick membership form.</li>
                    <li>✔ Step 2: Contribute ₹100/month or more – Support education & earn Social Points.</li>
                    <li>✔ Step 3: Unlock Benefits & Share Your Achievements – Influence decisions & showcase your impact.</li>
                </ul>
                <a href="{{url('member-register')}}" class="">Support a Student Now!</a>

            </div>
        </div>
    </div>
</section>

<!-- social points -->

<section class="bg-very-light-gray py-1 ">
    <div class="container">
        <div class="tab-container">
            <h2 class="membrr-all text-center py-4">Membership That Works for You!</h2>
            <div class="points-tabs">
                <div class="point-tab" data-tab="content-one">Social Point System</div>
                <div class="point-tab" data-tab="content-two">Ranks </div>
                <div class="point-tab" data-tab="content-three">Voting Rights</div>
            </div>

            <div id="content-one" class="point-tab-content active">
                <div class="container">
                    <div class="row py-4">
                        <h3 class="text-center py-3">Social Point System</h3>
                        <p class="text-center">Every contribution is fairly counted, and Social Points ensure your true impact is recognised
                            with full transparency.</p>
                        <div class="table-content-div">
                            <table class="table table-striped social-pint-tbl">
                                <thead>
                                    <tr>
                                        <th>Activity</th>
                                        <th>Social Points Earned</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <tr>
                                        <td>Membership/Donation Contribution (Every ₹10)</td>
                                        <td>1 Point</td>
                                    </tr>
                                    <tr>
                                        <td>1 Hour of Volunteering</td>
                                        <td>10 Points</td>
                                    </tr>
                                    <tr>
                                        <td>Referring a New Member</td>
                                        <td>10% of Their Earned Points (Lifetime)</td>
                                    </tr>
                                    <tr>
                                        <td>Completing Tasks on Dashboard</td>
                                        <td>Points Based on Task Difficulty</td>
                                    </tr>
                                    <tr>
                                        <td></td>
                                        <td></td>
                                    </tr>
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
            </div>
            <div id="content-two" class="point-tab-content">
                <div class="container">
                    <h3 class="text-center py-3">Earn, Rank Up & Inspire Others!</h3>
                    <p class="text-center w-md-75  m-auto py-2">At GaamRaam, you don’t need connections—just dedication. Your efforts, contributions, and
                        passion will define your leadership and influence. Work for the cause, and your impact will speak
                        for itself.</p>
                    <div class="row">
                        <div class="table-content-div">
                            <table class="table table-striped social-pint-tbl">
                                <thead>
                                    <tr>
                                        <th>Rank</th>
                                        <th>Points Required</th>
                                        <th>Privileges & Influence</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <tr>
                                        <td>Parivarjan -Family Member</td>
                                        <td>100</td>
                                        <td>Become a recognized member of the GaamRaam family and</td>
                                    </tr>
                                    <tr>
                                        <td>Sahyogi -Supporter</td>
                                        <td>20,000</td>
                                        <td>Actively contribute, participate in initiatives, and gain.</td>
                                    </tr>
                                    <tr>
                                        <td>Nayak -Leader</td>
                                        <td>50,000</td>
                                        <td>Lead initiatives, inspire others, and drive meaningful change.</td>
                                    </tr>
                                    <tr>
                                        <td>Nirmata -Builder</td>
                                        <td>1,00,000</td>
                                        <td>Build and shape impactful initiatives for long-term</td>
                                    </tr>
                                </tbody>
                            </table>
                        </div>
                    </div>

                </div>
            </div>
            <div id="content-three" class="point-tab-content">
                <div class="container">
                    <h3 class="text-center py-3">Voting Rights – Shape Haryana’s Future!</h3>
                    <div class="row">
                        <div class="col-lg-6">
                            <div class="voting-pointss">
                                <h6>100% Transparency – Track Your Impact!</h6>
                                <ul>
                                    <li>✔ More Social Points = More Voting Power.</li>
                                    <li>✔ Help decide key initiatives & future programs.</li>
                                    <li>✔ Influence the direction of GaamRaam Trust at Block, District, State & National levels.</li>
                                </ul>

                            </div>
                        </div>
                        <div class="col-lg-6">
                            <div class="voting-pointss">
                                <h6>Earn More Social Points – Complete Tasks on Your Dashboard!</h6>
                                <ul>
                                    <li>✔ Complete tasks on your dashboard & earn extra points.</li>
                                    <li>✔ Rise to leadership by actively contributing.
                                    </li>
                                </ul>

                            </div>
                        </div>
                        <div class="col-lg-6">
                            <div class="voting-pointss">
                                <h6>Showcase Your Contributions on Social Media!</h6>

                                <ul>
                                    <li>✔ Instantly post your Social Points & contributions on Facebook, Twitter, LinkedIn & WhatsApp.</li>
                                    <li>✔ Encourage others to contribute & grow the movement.</li>
                                    <li>✔ Build a network of changemakers dedicated to free education.</li>
                                </ul>

                            </div>
                        </div>
                        <div class="col-lg-6">
                            <div class="voting-pointss">
                                <h6>Act Now – A Student’s Future Depends on You!</h6>
                                <ul>
                                    <li>✔ Your ₹100/month = Free UPSC & SSC Coaching for One More Student.</li>
                                    <li>✔ Be a Leader. Influence Decisions. Transform Lives.
                                    </li>
                                </ul>
                            </div>
                        </div>
                    </div>
                </div>
            </div>


        </div>
    </div>
</section>
<!-- <section class="bg-very-light-gray py-5">
    <div class="container">
        <h2 class="text-center py-5"> Social Points: Earn, Rank Up & Inspire Others!</h2>
        <p class="text-center">At GaamRaam, you don’t need connections—just dedication. Your efforts, contributions, and
            passion will define your leadership and influence. Work for the cause, and your impact will speak
            for itself.</p>
        <div class="row">

            <table class="table table-striped social-pint-tbl">
                <thead>
                    <tr>
                        <th>Rank</th>
                        <th>Points Required</th>
                        <th>Privileges & Influence</th>
                    </tr>
                </thead>
                <tbody>
                    <tr>
                        <td>Parivarjan -Family Member</td>
                        <td>100</td>
                        <td>Become a recognized member of the GaamRaam family and</td>
                    </tr>
                    <tr>
                        <td>Sahyogi -Supporter</td>
                        <td>20,000</td>
                        <td>Actively contribute, participate in initiatives, and gain.</td>
                    </tr>
                    <tr>
                        <td>Nayak -Leader</td>
                        <td>50,000</td>
                        <td>Lead initiatives, inspire others, and drive meaningful change.</td>
                    </tr>
                    <tr>
                        <td>Nirmata -Builder</td>
                        <td>1,00,000</td>
                        <td>Build and shape impactful initiatives for long-term</td>
                    </tr>
                </tbody>
            </table>
        </div>
        <div class="row py-4">
            <h4 class="text-center">Social Point System</h4>
            <p class="text-center">Every contribution is fairly counted, and Social Points ensure your true impact is recognised
                with full transparency.</p>
            <table class="table table-striped social-pint-tbl">
                <thead>
                    <tr>
                        <th>Activity</th>
                        <th>Social Points Earned</th>
                    </tr>
                </thead>
                <tbody>
                    <tr>
                        <td>Membership/Donation Contribution (Every ₹10)</td>
                        <td>1 Point</td>
                    </tr>
                    <tr>
                        <td>1 Hour of Volunteering</td>
                        <td>10 Points</td>
                    </tr>
                    <tr>
                        <td>Referring a New Member</td>
                        <td>10% of Their Earned Points (Lifetime)</td>
                    </tr>
                    <tr>
                        <td>Completing Tasks on Dashboard</td>
                        <td>Points Based on Task Difficulty</td>
                    </tr>
                    <tr>
                        <td></td>
                        <td></td>
                    </tr>
                </tbody>
            </table>
        </div>
    </div>

</section> -->

<!-- membership  privilage -->
<!-- <section class=" py-5">
    <div class="container">
        <h2 class="text-center pt-5"> Membership Ranks & Privileges</h2>
        <p class="text-center py-3">As you contribute more, your rank increases automatically, unlocking exclusive benefits.</p>
        <div class="row">
            <div class="col-lg-6">
                <div class="member-privilage">
                    <h6>Education Supporter (500 Points) – Block-Level Influence</h6>
                    <ul>
                        <li>✔ Participate in block-level decision-making</li>
                    </ul>
                    <h6>Community Builder (2,000 Points) – District-Level Influence</h6>
                    <ul>
                        <li>✔ Participate in district-level decision-making</li>
                        <li>✔ Get featured in local recognition programs</li>
                    </ul>
                </div>
            </div>
            <div class="col-lg-6">
                <div class="member-privilage">
                    <h6> Future Shaper (5,000 Points) – State-Level Influence</h6>
                    <ul>
                        <li>✔ Voting power in state-level GaamRaam programs</li>
                        <li>✔ Special access to state-wide educational initiatives</li>
                    </ul>
                    <h6> Visionary Leader (10,000+ Points) – National-Level Influence</h6>
                    <ul>
                        <li>✔ Influence national-level GaamRaam policies & initiatives</li>
                        <li>✔ Special honors & leadership roles in the trust</li>
                    </ul>
                </div>
            </div>
        </div>
        <p class="text-center pt-5">Your influence grows with your contributions—achieve new milestones & lead the change!</p>
        <h5 class="text-center py-2"><a href="">Start Your Impact Today!</a></h5>

    </div>

</section> -->

<!-- voting rights section-->
<!-- <section class="bg-very-light-gray py-5">
    <div class="container">
        <h2 class="text-center py-5">Voting Rights – Shape Haryana’s Future!</h2>
        <div class="row">
            <div class="col-lg-6">
                <div class="voting-pointss">
                    <h6>100% Transparency – Track Your Impact!</h6>

                    <ul>
                        <li>✔ More Social Points = More Voting Power.</li>
                        <li>✔ Help decide key initiatives & future programs.</li>
                        <li>✔ Influence the direction of GaamRaam Trust at Block, District, State & National levels.</li>
                    </ul>
                    <p><a href=""> [Become a Voting Member] (Make Your Voice Count!)</a></p>
                </div>
            </div>
            <div class="col-lg-6">
                <div class="voting-pointss">
                    <h6>Earn More Social Points – Complete Tasks on Your Dashboard!</h6>
                    <p>Engage with GaamRaam & Get Rewarded!</p>
                    <ul>
                        <li>✔ Complete tasks on your dashboard & earn extra points.</li>
                        <li>✔ Rise to leadership by actively contributing.
                        </li>
                    </ul>
                    <p><a href="">Complete Tasks & Earn More</a></p>

                </div>
            </div>
            <div class="col-lg-6">
                <div class="voting-pointss">
                    <h6>Showcase Your Contributions on Social Media!</h6>
                    <p>Inspire Others – Share Your Impact!</p>
                    <ul>
                        <li>✔ Instantly post your Social Points & contributions on Facebook, Twitter, LinkedIn & WhatsApp.</li>
                        <li>✔ Encourage others to contribute & grow the movement.</li>
                        <li>✔ Build a network of changemakers dedicated to free education.</li>
                    </ul>
                    <p><a href="">Share My Contributions (Post & Inspire!)</a></p>
                </div>
            </div>
            <div class="col-lg-6">
                <div class="voting-pointss">
                    <h6>Act Now – A Student’s Future Depends on You!</h6>
                    <p>Engage with GaamRaam & Get Rewarded!</p>
                    <ul>
                        <li>✔ Your ₹100/month = Free UPSC & SSC Coaching for One More Student.</li>
                        <li>✔ Be a Leader. Influence Decisions. Transform Lives.
                        </li>
                    </ul>
                    <p><a href="">Start Your Impact Today!</a></p>
                    <p><a href="">View Transparency Report </a></p>

                </div>
            </div>
        </div>
    </div>

</section> -->

<!-- <section class="slider-container my-4">
    <div class="container">
        <h3 class="text-center">Our Community</h3>
        <div id="memberCarousel" class="carousel slide my-5" data-bs-ride="carousel">
            <div class="carousel-inner">
                <div class="carousel-item active">
                    <div class="row">
                        @isset($members)
                        @foreach($members as $member)
                        <div class="col-6 col-md-2">
                            <img src="{{ asset($member->profile_image) }}" alt="{{ asset($member->profile_image) }}" class="d-block w-100">
                        </div>
                        @endforeach
                        @endisset

                    </div>
                </div>

            </div>

          
            <button class="carousel-control-prev" type="button" data-bs-target="#memberCarousel" data-bs-slide="prev">
                <span class="carousel-control-prev-icon"></span>
            </button>
            <button class="carousel-control-next" type="button" data-bs-target="#memberCarousel" data-bs-slide="next">
                <span class="carousel-control-next-icon"></span>
            </button>
        </div>
    </div>
</section> -->
<script>
    document.querySelectorAll(".custom-tab").forEach(tab => {
        tab.addEventListener("click", function() {
            document.querySelectorAll(".custom-tab").forEach(t => t.classList.remove("active"));
            document.querySelectorAll(".custom-tab-content").forEach(content => content.classList.remove("active"));

            this.classList.add("active");
            document.getElementById(this.dataset.tab).classList.add("active");
        });
    });
</script>
<script>
    // tab system
    document.addEventListener("DOMContentLoaded", function() {
        let tabs = document.querySelectorAll('.point-tab');
        tabs.forEach(tab => {
            tab.addEventListener('click', function() {
                let tabId = this.getAttribute('data-tab');

                document.querySelectorAll('.point-tab').forEach(t => t.classList.remove('active'));
                document.querySelectorAll('.point-tab-content').forEach(c => c.classList.remove('active'));

                this.classList.add('active');
                document.getElementById(tabId).classList.add('active');
            });
        });

        document.querySelector('.point-tab').classList.add('active');
    });

    // tab system end.

    function toggleview() {
        var content = document.getElementById("showcontent");
        var button = document.getElementById("toggleviewbtn");

        if (content.style.display === "none") {
            content.style.display = "block";
            button.innerHTML = "See Less";
        } else {
            content.style.display = "none";
            button.innerHTML = "See More";
        }
    }
</script>
@endsection