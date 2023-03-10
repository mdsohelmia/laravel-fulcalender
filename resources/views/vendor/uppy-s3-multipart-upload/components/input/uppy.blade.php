{{-- http://localhost:8085 --}}
<div x-data x-init="
        onUploadSuccess = (elForUploadedFiles) =>
          (file, response) => {
            const url = response.uploadURL;
            const fileName = file.name;

            const uploadedFileData = JSON.stringify(response.body);

            const li = document.createElement('li');
            const a = document.createElement('a');
            a.href = url;
            a.target = '_blank';
            a.appendChild(document.createTextNode(fileName));
            li.appendChild(a);

            document.querySelector(elForUploadedFiles).appendChild(li);

            var inputElementUrlUploadFile = document.getElementById('{{ $hiddenField }}');
            inputElementUrlUploadFile.value = url;
            inputElementUrlUploadFile.dispatchEvent(new Event('input'));

            {{ $extraJSForOnUploadSuccess }}
          };

     	   uppyUpload{{ $hiddenField }} = new Uppy({
                debug: true,
                autoProceed: true,
				allowMultipleUploads: true,
      			allowMultipleUploadBatches: true
            });

        uppyUpload{{ $hiddenField }}
          .use(DragDrop, {{ $dragDropOptions }})
          .use(AwsS3Multipart, {
              companionUrl: 'https://apistream.gotipath.com/',
              companionHeaders:
              {
                  'X-CSRF-TOKEN': window.csrfToken,
              },
          })
          .use(StatusBar, {{ $statusBarOptions }})
		  .on('file-added', (file) =>{
				uppyUpload{{ $hiddenField }}.setFileMeta(file.id, {
					video_id: 'b1499d37-8b26-403f-8947-1ae3193b09e7',
					library_id:'b1499d37-8b26-403f-8947-1ae3193b09e7',
					collection_id:'b1499d37-8b26-403f-8947-1ae3193b09e7'
				});
			})
          .on('upload-success', onUploadSuccess('.{{ $uploadElementClass }} .uploaded-files ol'));
    ">
	<section class="{{ $uploadElementClass }}">
		<div class="for-DragDrop" x-ref="input"></div>

		<div class="for-ProgressBar"></div>

		<div class="uploaded-files">
			<h5>{{ __('Uploaded file:') }}</h5>
			<ol></ol>
		</div>
	</section>
</div>
