@extends('layouts.admin.template')

@section('page_css')
	<link rel="stylesheet" href="{{ asset('admin/css/use-bootstrap-tag.min.css') }}">

	<style>
		.ck-editor__editable_inline:not(.ck-comment__input *) {
			height: 300px;
			overflow-y: auto;
		}
	</style>
@endsection

@section('content')
<div class="page-heading">
	<div class="page-title">
		<div class="row">
			<div class="col-12 col-md-6 order-md-1 order-last">
				<h3>Features</h3>
			</div>
			<div class="col-12 col-md-6 order-md-2 order-first">
				<nav
					aria-label="breadcrumb"
					class="breadcrumb-header float-start float-lg-end"
				>
					<ol class="breadcrumb">
						<li class="breadcrumb-item">
							<a href="{{ route('dashboard') }}">Dashboard</a>
						</li>
						<li class="breadcrumb-item active" aria-current="page">
							Edit Poem
						</li>
					</ol>
				</nav>
			</div>
		</div>
	</div>

	<section id="basic-vertical-layouts">
		<div class="row match-height">
			<div class="col-12">
				<div class="card">
					<div class="card-header">
						<h4 class="card-title">Edit Poem</h4>
					</div>
					<div class="card-content">
						<div class="card-body">
							<form class="form form-vertical" action="{{ route('article.update', $post->id) }}" enctype="multipart/form-data" method="POST" id="editPost">
								@method('PATCH')
								@csrf
								<div class="form-body">
									<div class="row">
										<div class="col-12">
											<div class="form-group">
												<label for="first-name-vertical">Title*</label>
												<input
													type="text"
													class="form-control"
													name="title"
													value="{{ $post->title }}"
												/>
												@if ($errors->has('title'))
													<span class="help-block text-danger">
														<p>{{ $errors->first('title') }}</p>
													</span>
												@endif
											</div>
										</div>
										<div class="col-12">
											<div class="form-group">
												<label for="email-id-vertical">Content*</label>
												<textarea id="content" name="content">
													{!! $post->content !!}
												</textarea>
												@if ($errors->has('content'))
													<span class="help-block text-danger">
														<p>{{ $errors->first('content') }}</p>
													</span>
												@endif
											</div>
										</div>
										<div class="col-12">
											<div class="form-group">
												<label for="contact-info-vertical">Category*</label>
												<select class="form-control" style="width: 100%;" name="category_id">
													<option value="{{ $post->id }}">{{ $post->category->name }}</option>
													@foreach ($categories as $category)
														<option value="{{ $category->id }}">{{ $category->name }}</option>
													@endforeach
												</select>
											</div>
										</div>
										<div class="col-12">
											<div class="form-group">
												<label for="password-vertical">Image*</label>
												<input
													class="form-control"
													type="file"
													id="image"
													name="image"
												/>
											</div>

											<img id="preview_image" class="inputImgPreview w-25 mt-2" src="{{ asset('uploads/' . $post->image ?? '') }}" />

											@if ($errors->has('image'))
												<span class="help-block text-danger">
													<p>{{ $errors->first('image') }}</p>
												</span>
											@endif
										</div>
										<div class="col-12">
											<div class="form-group">
												<label for="first-name-vertical">Tags*</label>
												<input
													type="text"
													class="form-control"
													name="tags"
													id="tags"
													data-ub-tag-variant="dark"
													value="{{ $post->tags }}"
												/>

												@if ($errors->has('tags'))
													<span class="help-block text-danger">
														<p>{{ $errors->first('tags') }}</p>
													</span>
												@endif
											</div>
										</div>

										<div class="col-12">
											<div class="form-group">
												<label class="mb-1">Allow comment?</label>
												<div class="form-check">
													<input
														class="form-check-input form-check-success"
														type="radio"
														name="allowed_comment"
														id="yesComment"
														value="1"
														{{ $post->allowed_comment == 1 ? 'checked' : '' }}
													/>
													<label
														class="form-check-label"
														for="yesComment"
													>
														Yes
													</label>
												</div>
												<div class="form-check">
													<input
														class="form-check-input form-check-danger"
														type="radio"
														name="allowed_comment"
														id="noComment"
														value="0"
														{{ $post->allowed_comment == 0 ? 'checked' : '' }}
													/>
													<label
														class="form-check-label"
														for="noComment"
													>
														No
													</label>
												</div>
											</div>
										</div>
										<div class="col-12">
											<div class="form-group">
												<label class="mb-1">Publish article?</label>
												<div class="form-check">
													<input
														class="form-check-input form-check-success"
														type="radio"
														name="active"
														id="publishRadio"
														value="1"
														{{ $post->active == 1 ? 'checked' : '' }}
													/>
													<label
														class="form-check-label"
														for="publishRadio"
													>
														Yes
													</label>
												</div>
												<div class="form-check">
													<input
														class="form-check-input form-check-danger"
														type="radio"
														name="active"
														id="unpublishedRadio"
														value="0"
														{{ $post->active == 0 ? 'checked' : '' }}
													/>
													<label
														class="form-check-label"
														for="unpublishedRadio"
													>
														No
													</label>
												</div>
											</div>
										</div>
										<div class="col-12 d-flex justify-content-end">
											<button
												type="submit"
												class="btn btn-primary btn-block me-1 my-2"
											>
												Update
											</button>
										</div>
									</div>
								</div>
							</form>
						</div>
					</div>
				</div>
			</div>
		</div>
	</section>
</div>
@endsection

@section('page_scripts')
	<script type="text/javascript" src="{{ asset('admin/js/ckeditor.js')}}"></script>
	<script type="text/javascript" src="{{ asset('admin/js/use-bootstrap-tag.min.js')}}"></script>

	<script type="text/javascript" src="{{ asset('admin/js/jquery.min.js')}}"></script>

	<script>
		ClassicEditor
			.create(document.querySelector('#content'))
			.catch(error => {
				console.error(error);
			});
	</script>

	<script type="text/javascript">
		UseBootstrapTag(document.getElementById('tags'))

		document.getElementById('image').addEventListener('change', function(e) {
			var fileName = e.target.files[0].name;
			document.getElementById('file-label').textContent = fileName;
		});

		function readURL(input) {
			if (input.files && input.files[0]) {
				var reader = new FileReader();
				var targetPreview = 'preview_'+$(input).attr('id');
				reader.onload = function(e) {
						$('#'+targetPreview).attr('src', e.target.result).show();
				}
				reader.readAsDataURL(input.files[0]);
			}
		}
		$("#image").change(function() {
			readURL(this);
		});
	</script>
@endsection

