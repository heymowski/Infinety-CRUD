<!-- include redactor js-->
<script type="text/javascript" src="//cdnjs.cloudflare.com/ajax/libs/fancybox/2.1.5/jquery.fancybox.min.js"></script>
<script src="{{ asset('/admin_theme/assets/plugins/redactor/redactor.js') }}"></script>
<script src="{{ asset('/admin_theme/assets/plugins/redactor/plugins/fullscreen.js') }}" type="text/javascript"></script>
<script src="{{ asset('/admin_theme/assets/plugins/redactor/plugins/imagemanager.js') }}" type="text/javascript"></script>
<script src="{{ asset('/admin_theme/assets/plugins/redactor/plugins/video.js') }}" type="text/javascript"></script>
<script>

	@foreach($language as $localeCode => $properties)
	//		$('.redactor').redactor();
	jQuery(document).ready(function($) {
		$('#redactor-{{$properties["iso"]}}').redactor({
			minHeight: 350,
			maxHeight: 800,
			cleanOnPaste: true,
			cleanSpaces: true,
			removeComments: true,
			removeEmpty: ['strong', 'em', 'span', 'p'],
			buttonsHide: ['orderedlist', 'image'],
			formatting: ['p', 'blockquote', 'h2', 'h3', 'h4'],
			plugins: ['fullscreen',  'video', 'imagemanager'],
			imageManagerUrl: "{{ url('admin/filemanager/dialog') }}?type=editor&editor=redactor-{{$properties["iso"]}}"
		});
	});

	@endforeach

</script>