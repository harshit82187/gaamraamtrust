@extends('admin.layout.app')
@section('content')
    <div class="card">
        <div class="card-header" style="display: flex;justify-content: space-between;align-items: center;">
            <h3>{{ $course->name ?? '' }} Info</h3>
            <a href="{{ route('admin.courses') }}" class="btn btn-dark btn-sm">Back</a>
        </div>

        <div class="card-body">
            <form action="{{ route('admin.update-course') }}" method="POST" enctype="multipart/form-data">
                @csrf
                <input type="hidden" name="course_id" value="{{ $course->id }}">
                <div class="row">
                    <div class="col-12">
                        <img src="{{ asset($course->image) }}" alt="image" width="120px" height="120px" style="margin-left: 42%;" >
                    </div>
                </div>
                <div class="row">
                    <div class="col-6">
                        <label>Upload Image</label> <span class="text-danger">*</span>
                        <input type="file" class="form-control" name="image" accept="image/*">
                    </div>
                    <div class="col-6">
                        <label>Course Name</label> <span class="text-danger">*</span>
                        <input type="text" class="form-control" name="name" value="{{ $course->name }}" required
                            placeholder="Enter course name">
                    </div>

                </div>
                    
                    <div class="col-12" style="margin-top: 2%;">
                        @if($course->id == 1)
                        <label>What Is  {{ $course->name }}</label> <span class="text-danger">*</span>
                        @else 
                        <label>What is SSC & HSSC, and Why Are They Important?</label> <span class="text-danger">*</span>
                        @endif
                        <textarea class="form-control editor" name="tab_one" rows="5" placeholder="Enter Details" required>{{ $course->tab_one }}</textarea>
                    </div>

                    <div class="col-12" style="margin-top: 2%;">
                        @if($course->id == 1)
                        <label>Who Can Apply For  {{ $course->name }}</label> <span class="text-danger">*</span>
                        @else
                        <label>Eligibility Criteria for SSC & HSSC Exams  </label> <span class="text-danger">*</span>
                        @endif
                        <textarea class="form-control editor" name="tab_two" rows="5" placeholder="Enter Details" required>{{ $course->tab_two }}</textarea>
                    </div>

                    <div class="col-12" style="margin-top: 2%;">
                        @if($course->id == 1)
                        <label>Exam Structure</label> <span class="text-danger">*</span>
                        @else 
                        <label>SSC & HSSC Exam Stages & Pattern</label> <span class="text-danger">*</span>
                        @endif
                        <textarea class="form-control editor" name="tab_three" rows="5" placeholder="Enter Details" required>{{ $course->tab_three }}</textarea>
                    </div>

                    <div class="col-12" style="margin-top: 2%;">
                        @if($course->id == 1)
                        <label>Course Plan & Schedule</label> <span class="text-danger">*</span>
                        @else 
                        <label>SSC CGL 2026 & HSSC Target Course & Schedule 🌟</label> <span class="text-danger">*</span>
                        @endif
                        <textarea class="form-control editor" name="tab_four" rows="5" placeholder="Enter Details" required>{{ $course->tab_four }}</textarea>
                    </div>

                    <div class="col-12"  style="margin-top: 2%;">
                        <label>Why Join Us</label> <span class="text-danger">*</span>
                        <div id="join_us_Fields">
                            @if (!empty($whyJoinUs))
                                    @foreach ($whyJoinUs as $index => $whyJoinU)
                                        <div class="row mb-2">
                                            <div class="col-10">
                                                <input type="text" class="form-control" name="why_join_us[]" value="{{ $whyJoinU }}" required placeholder="Enter Tag">
                                            </div>
                                            <div class="col-2">
                                                @if ($index == 0)
                                                    <button type="button" class="btn btn-success add-join">+</button>
                                                    @else 
                                                    <button type="button" class="btn btn-danger remove-join">-</button>
                                                @endif
                                            </div>
                                        </div>
                                    @endforeach
                                @else 
                                <div class="row mb-2">
                                    <div class="col-10">
                                        <input type="text" class="form-control" name="why_join_us[]" required placeholder="Enter Join Us Detail">
                                    </div>
                                    <div class="col-2">
                                        <button type="button" class="btn btn-success add-join">+</button>
                                    </div>
                                </div>
                            @endif
                        </div>
                    </div>

                    <div class="col-12"  style="margin-top: 2%;">
                        <label>Program Includes</label> <span class="text-danger">*</span>
                        <div id="tagFields">
                            @if (!empty($programs))
                                    @foreach ($programs as $index => $program)
                                        <div class="row mb-2">
                                            <div class="col-10">
                                                <input type="text" class="form-control" name="programs[]" value="{{ $program }}" required placeholder="Enter Tag">
                                            </div>
                                            <div class="col-2">
                                                @if ($index == 0)
                                                    <button type="button" class="btn btn-success add-tag">+</button>
                                                    @else 
                                                    <button type="button" class="btn btn-danger remove-tag">-</button>
                                                @endif
                                            </div>
                                        </div>
                                    @endforeach
                                @else 
                                <div class="row mb-2">
                                    <div class="col-10">
                                        <input type="text" class="form-control" name="programs[]" required placeholder="Enter Programs Detail">
                                    </div>
                                    <div class="col-2">
                                        <button type="button" class="btn btn-success add-tag">+</button>
                                    </div>
                                </div>
                            @endif
                        </div>
                    </div>

                    <div class="col-12" style="margin-top: 2%;">
                        @if($course->id == 1)
                        <label>Prelims Preparation Plan</label> <span class="text-danger">*</span>
                        @else 
                        <label>SSC & HSSC Exam Preparation Plan</label> <span class="text-danger">*</span>
                        @endif
                        <textarea class="form-control editor" name="preparation_plans" rows="5" placeholder="Enter Details" required>{{ $course->preparation_plans }}</textarea>
                    </div>

                    {{-- <div class="col-12"  style="margin-top: 2%;">
                        <label>Prelims Preparation Plan</label> <span class="text-danger">*</span>
                        <div id="preparation_plans_Fields">
                            @if (!empty($preparation_plans))
                                    @foreach ($preparation_plans as $index => $preparation_plan)
                                        <div class="row mb-2">
                                            <div class="col-10">
                                                <input type="text" class="form-control" name="preparation_plans[]" value="{{ $preparation_plan }}" required placeholder="Enter Tag">
                                            </div>
                                            <div class="col-2">
                                                @if ($index == 0)
                                                    <button type="button" class="btn btn-success add-preparation">+</button>
                                                    @else 
                                                    <button type="button" class="btn btn-danger remove-preparation">-</button>
                                                @endif
                                            </div>
                                        </div>
                                    @endforeach
                                @else 
                                <div class="row mb-2">
                                    <div class="col-10">
                                        <input type="text" class="form-control" name="preparation_plans[]" required placeholder="Enter Preparation Plans Detail">
                                    </div>
                                    <div class="col-2">
                                        <button type="button" class="btn btn-success add-preparation">+</button>
                                    </div>
                                </div>
                            @endif
                        </div>
                    </div> --}}

                    <div class="col-12"  style="margin-top: 2%;">
                        <label>Mains Answer Writing & Test Series</label> <span class="text-danger">*</span>
                        <div id="test_series_Fields">
                            @if (!empty($test_series))
                                    @foreach ($test_series as $index => $test_serie)
                                        <div class="row mb-2">
                                            <div class="col-10">
                                                <input type="text" class="form-control" name="test_series[]" value="{{ $test_serie }}" required placeholder="Enter Tag">
                                            </div>
                                            <div class="col-2">
                                                @if ($index == 0)
                                                    <button type="button" class="btn btn-success add-test_series">+</button>
                                                    @else 
                                                    <button type="button" class="btn btn-danger remove-test_series">-</button>
                                                @endif
                                            </div>
                                        </div>
                                    @endforeach
                                @else 
                                <div class="row mb-2">
                                    <div class="col-10">
                                        <input type="text" class="form-control" name="test_series[]" required placeholder="Enter Test Series Detail">
                                    </div>
                                    <div class="col-2">
                                        <button type="button" class="btn btn-success add-test_series">+</button>
                                    </div>
                                </div>
                            @endif
                        </div>
                    </div>

                    <div class="col-12"  style="margin-top: 2%;">
                        <label>Eligibility Criteria for Admission</label> <span class="text-danger">*</span>
                        <div id="criteria_Fields">
                            @if (!empty($criterias))
                                    @foreach ($criterias as $index => $criteria)
                                        <div class="row mb-2">
                                            <div class="col-10">
                                                <input type="text" class="form-control" name="criteria[]" value="{{ $criteria }}" required placeholder="Enter Tag">
                                            </div>
                                            <div class="col-2">
                                                @if ($index == 0)
                                                    <button type="button" class="btn btn-success add-criteria">+</button>
                                                    @else 
                                                    <button type="button" class="btn btn-danger remove-criteria">-</button>
                                                @endif
                                            </div>
                                        </div>
                                    @endforeach
                                @else 
                                <div class="row mb-2">
                                    <div class="col-10">
                                        <input type="text" class="form-control" name="criteria[]" required placeholder="Enter Criteria Detail">
                                    </div>
                                    <div class="col-2">
                                        <button type="button" class="btn btn-success add-criteria">+</button>
                                    </div>
                                </div>
                            @endif
                        </div>
                    </div>
    
                    <div class="col-2" style="margin-top: 2%;">
                        <input type="submit" class="btn btn-primary " value="Update">
                    </div>
                

                {{-- <div class="col-12" style="margin-top: 2%;">
                    <label>Why Choose Us</label> <span class="text-danger">*</span>
                    <div id="courseDetails">
                        @if (!empty($whyJoinUs))
                            @foreach ($whyJoinUs as $index => $whyJoinU)
                                <div class="row mb-2">
                                    <div class="col-5">
                                        <input type="text" class="form-control" name="key[]" placeholder="Enter Key"
                                            value="{{ $whyJoinU['key'] }}">
                                    </div>
                                    <div class="col-5">
                                        <input type="text" class="form-control" name="value[]" placeholder="Enter Value"
                                            value="{{ $whyJoinU['value'] }}">
                                    </div>
                                    <div class="col-2">
                                        @if ($index == 0)
                                            <button type="button" class="btn btn-success add-row">+</button>
                                        @else
                                            <button type="button" class="btn btn-danger remove-row">-</button>
                                        @endif
                                    </div>
                                </div>
                            @endforeach
                        @else
                            <div class="row mb-2">
                                <div class="col-5">
                                    <input type="text" class="form-control" name="key[]" placeholder="Enter Key">
                                </div>
                                <div class="col-5">
                                    <input type="text" class="form-control" name="value[]" placeholder="Enter Value">
                                </div>
                                <div class="col-2">
                                    <button type="button" class="btn btn-success add-row">+</button>
                                </div>
                            </div>
                        @endif
                    </div>
                </div> --}}

             


            </form>

        </div>
        <br>

    </div>

@endsection
@push('js')
<script>
    $(document).ready(function() {
        $('.editor').each(function() {
            new Jodit(this, {
                height: 300, // Adjust the editor height
                toolbarSticky: false, // Toolbar will not stick on scroll
                defaultMode: "1", // Start in WYSIWYG mode
                uploader: {
                    insertImageAsBase64URI: true // Allows direct image uploads
                }
            });
        });
    });
</script>


    {{-- <script>
        $(document).ready(function() {
            // Add new row
            $(document).on("click", ".add-row", function() {
                let rowHtml = `<div class="row mb-2">
				<div class="col-5">
					<input type="text" class="form-control" name="key[]" placeholder="Enter Key">
				</div>
				<div class="col-5">
					<input type="text" class="form-control" name="value[]" placeholder="Enter Value">
				</div>
				<div class="col-2">
					<button type="button" class="btn btn-danger remove-row">-</button>
				</div>
			</div>`;
                $("#courseDetails").append(rowHtml);
            });
            // Remove row
            $(document).on("click", ".remove-row", function() {
                $(this).closest(".row").remove();
            });
        });
    </script> --}}

	<script>
		$(document).ready(function () {
			$(document).on("click", ".add-tag", function () {
				let tagField = `<div class="row mb-2">
					<div class="col-10">
						<input type="text" class="form-control" name="programs[]" required placeholder="Enter Program Detail">
					</div>
					<div class="col-2">
						<button type="button" class="btn btn-danger remove-tag">-</button>
					</div>
				</div>`;
				$("#tagFields").append(tagField);
			});
			$(document).on("click", ".remove-tag", function () {
				$(this).closest(".row").remove();
			});

            $(document).on("click", ".add-join", function () {
				let tagField = `<div class="row mb-2">
					<div class="col-10">
						 <input type="text" class="form-control" name="why_join_us[]" required placeholder="Enter Join Us Detail">
					</div>
					<div class="col-2">
						<button type="button" class="btn btn-danger remove-join">-</button>
					</div>
				</div>`;
				$("#join_us_Fields").append(tagField);
			});
			$(document).on("click", ".remove-join", function () {
				$(this).closest(".row").remove();
			});

            $(document).on("click", ".add-preparation", function () {
				let tagField = `<div class="row mb-2">
					<div class="col-10">
                        <input type="text" class="form-control" name="preparation_plans[]" required placeholder="Enter Preparation Plans Detail">
					</div>
					<div class="col-2">
						<button type="button" class="btn btn-danger remove-preparation">-</button>
					</div>
				</div>`;
				$("#preparation_plans_Fields").append(tagField);
			});
			$(document).on("click", ".remove-preparation", function () {
				$(this).closest(".row").remove();
			});


            $(document).on("click", ".add-test_series", function () {
				let tagField = `<div class="row mb-2">
					<div class="col-10">
                        <input type="text" class="form-control" name="test_series[]" required placeholder="Enter Test Series Detail">
					</div>
					<div class="col-2">
						<button type="button" class="btn btn-danger remove-test_series">-</button>
					</div>
				</div>`;
				$("#test_series_Fields").append(tagField);
			});
			$(document).on("click", ".remove-test_series", function () {
				$(this).closest(".row").remove();
			});

            $(document).on("click", ".add-criteria", function () {
				let tagField = `<div class="row mb-2">
					<div class="col-10">
                        <input type="text" class="form-control" name="criteria[]" required placeholder="Enter Criteria Detail">
					</div>
					<div class="col-2">
						<button type="button" class="btn btn-danger remove-criteria">-</button>
					</div>
				</div>`;
				$("#criteria_Fields").append(tagField);
			});
			$(document).on("click", ".remove-criteria", function () {
				$(this).closest(".row").remove();
			});
		});
	</script>
@endpush
