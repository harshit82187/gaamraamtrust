@extends('front.layout.app')
@section('content')

<section class="page-title-section bg-img cover-background top-position1 left-overlay-dark" data-overlay-dark="9" data-background="img/bg/bg-04.jpg">
	<div class="container">
		<div class="row text-center">
			<div class="col-md-12">
				<h1>{{ $course->name ?? '' }}</h1>
			</div>
			<div class="col-md-12">
				<ul>
					<li><a href="{{url('/')}}">Home</a></li>
					<li><a href="{{ url('course')}}">Course</a></li>
					<li><a href="javascript:void(0)">{{ $course->name ?? '' }}</a></li>

				</ul>
			</div>
		</div>
	</div>
</section>

<section class="courses">
	<div class="container">
		<div class="row">
			<div class="col-md-12 col-lg-8 mb-2-9 mb-lg-0">
				<div class="row">
					<div class="col-md-12 mb-1-6 mb-md-1-9">
						<div class="courses-info mb-4">
							<div class="bg-light rounded py-4 px-4 mb-3">

								<h2 class="h1 mb-0">{{ $course->name ?? '' }}</h2>
							</div>
						</div>
						<figure class="mb-0">
							<img class="border-radius-5" src="{{ asset($course->image) }}" alt="{{ asset($course->image) }}">
						</figure>
					</div>
					<div class="col-md-12 mb-1-6 mb-md-2-9">
						<div class="horizontaltab tab-style1">
							<ul class="resp-tabs-list hor_1">
								@php
									$courseDetails = [
										1 => [
											'What is UPSC?',
											'Who Can Apply for UPSC?',
											'Exam Structure',
											'Course Plan & Schedule'
										],
										2 => [
											'What is SSC & HSSC, and Why Are They Important?',
											'Eligibility Criteria for SSC & HSSC Exams',
											'SSC & HSSC Exam Stages & Pattern',
											'SSC CGL 2026 & HSSC Target Course & Schedule 🌟'
										]
									];
								@endphp							
							@if(isset($courseDetails[$course->id]))
								@foreach($courseDetails[$course->id] as $detail)
									<li><span class="display-block xs-display-inline-block">{{ $detail }}</span></li>
								@endforeach
							@endif						

							</ul>
							<div class="resp-tabs-container hor_1">
								<div>
									<div class="row">
										{!! $course->tab_one ?? '' !!}
									</div>

								</div>
								<div>

									<div class="tab2-content">
										{!! $course->tab_two !!}
									</div>									
								

								</div>

								<!-- tab3 -->
								<div>
									<div class="tab2-content">
										{!! $course->tab_three !!}
										

									
									</div>

								</div>

								<!-- tab4 -->
								<div>
									<div class="tab2-content">
										{!! $course->tab_four !!}
									
									</div>
								</div>
							</div>
						</div>
					</div>

				</div>

			</div>
			<!--  start courses list right-->
			<div class="col-md-12 col-lg-4">
				<div class="ps-lg-1-6 ps-xl-1-9">
					<div class="sidebar">

						<div class="widget">
							<div class="widget-title">
								<!-- <h3>Course details</h3> -->
								<h3>Why Join Us?</h3>
								<ul>
									@isset($why_join_usDetails)
									@foreach($why_join_usDetails as $why_join_usDetail)
									<li>{{ $why_join_usDetail }}</li>
									@endforeach
									@endisset
									
								</ul>
							</div>
					
						</div>
						<div class="widget">
							<div class="widget-title">
								<!-- <h3>Course Categories</h3> -->
								<h3>Program Includes:</h3>

							</div>
							<ul>
								@isset($programsDetails)
									@foreach($programsDetails as $programsDetail)
									<li>{{ $programsDetail }}</li>
									@endforeach
								@endisset
							</ul>
							<!-- <ul class="category-list">
								<li><i class="fas fa-hand-point-right"></i>Foundation Course <span>🏛️</span></li>
								<li><i class="fas fa-hand-point-right"></i> Prelims Crash Course <span>⏳</span></li>
								<li><i class="fas fa-hand-point-right"></i>Mains Answer Writing Program <span>✍️</span></li>
								<li><i class="fas fa-hand-point-right"></i>Optional Subject Coaching <span>📚</span></li>
								<li><i class="fas fa-hand-point-right"></i>Interview Guidance Program (Personality Test) <span>🎙️</span></li>
								<li><i class="fas fa-hand-point-right"></i>Weekend & Working Professionals’ Seminar's <span>🏢</span></li>
							</ul> -->
						</div>
						<div class="widget">
							<div class="widget-title">
								<!-- <h3>Popular Tags</h3> -->
								@if($course->id == 1)
								<h3>Prelims Preparation Plan</h3>
								@elseif($course->id == 2)
								<h3>SSC & HSSC Exam Preparation Plan</h3>
								@endif
							</div>
							<ul style="margin-left:-9%;">
								{!! $course->preparation_plans !!}
							</ul>
							<!-- <ul class="course-tags">
								@foreach($tagsDetails as $tagsDetail)
								<li><a href="javascript:void(0)">{{ $tagsDetail }}</a></li>
								@endforeach

							</ul> -->
						</div>
						<div class="widget">
							<div class="widget-title">
								<h3>Mains Answer Writing & Test Series</h3>

							</div>
							<ul>
								@isset($test_seriesDetails)
									@foreach($test_seriesDetails as $test_seriesDetail)
									<li>{{ $test_seriesDetail }}</li>
									@endforeach
								@endisset
							</ul>
							<!-- <h4 class="display-27 display-md-25 display-xl-20 font-weight-800 mb-1-6 text-capitalize mt-3">Related Courses</h4> -->
							<!-- <div class="owl-carousel owl-theme related-courses-carousel">
								@isset($otherCourses)
								@foreach($otherCourses as $otherCourse)
								<div class="card card-style1 p-0 h-100">
									<a href="{{ route('course-detail',$otherCourse->slug) }}">
										<div class="card-img rounded-0">
											<div class="image-hover">
												<img class="rounded-top" src="{{ asset($otherCourse->image) }}" alt="{{ asset($otherCourse->image) }}">
											</div>

										</div>
										<div class="card-body position-relative pt-0 px-1-9 pb-1-9">
											<div class="pt-6">
												<h4 class="h4 mb-4">{{ $otherCourse->name }}</h4>
											</div>
										</div>
									</a>

								</div>
								@endforeach
								@endif

							</div> -->
						</div>
						<div class="widget">
							<div class="widget-title">
								<h3>Eligibility Criteria for Admission:</h3>
							</div>
							<ul>
								@isset($criteriaDetails)
									@foreach($criteriaDetails as $criteriaDetail)
									<li>{{ $criteriaDetail }}</li>
									@endforeach
								@endisset

							</ul>
						</div>
						<div class="widget">
							<div class="widget-title">
								<h4 class="display-27 display-md-25 display-xl-20 font-weight-800 mb-1-6 text-capitalize mt-3">Related Courses</h4>
							</div>
							<!-- <h4 class="display-27 display-md-25 display-xl-20 font-weight-800 mb-1-6 text-capitalize mt-3">Related Courses</h4> -->
							<div class="owl-carousel owl-theme related-courses-carousel">
								@isset($otherCourses)
								@foreach($otherCourses as $otherCourse)
								<div class="card card-style1 p-0 h-100">
									<a href="{{ route('course-detail',$otherCourse->slug) }}">
										<div class="card-img rounded-0">
											<div class="image-hover">
												<img class="rounded-top" src="{{ asset($otherCourse->image) }}" alt="{{ asset($otherCourse->image) }}">
											</div>

										</div>
										<div class="card-body position-relative pt-0 px-1-9 pb-1-9">
											<div class="pt-6">
												<h4 class="h4 mb-4">{{ $otherCourse->name }}</h4>
											</div>
										</div>
									</a>

								</div>
								@endforeach
								@endif

							</div>
						</div>

					</div>
				</div>

			</div>
			<!--  end courses list right-->
		</div>
	</div>
</section>
@endsection