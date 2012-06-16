<script type="text/javascript" src="javascripts/highslide/highslide-full.js"></script>
<script type="text/javascript">
	hs.graphicsDir = 'media/images/highslide/';
	hs.align = 'center';
	hs.transitions = ['expand', 'crossfade'];
	hs.fadeInOut = true;
	hs.dimmingOpacity = 1;
	hs.outlineType = 'rounded-white';
	hs.captionEval = 'this.thumb.alt';
	hs.marginBottom = 105; // make room for the thumbstrip and the controls
	hs.numberPosition = 'caption';
	hs.lang.restoreTitle = 'Click for next image';

	// Add the slideshow providing the controlbar and the thumbstrip
	hs.addSlideshow({
		//slideshowGroup: 'group1',
		interval: 5000,
		repeat: false,
		useControls: true,
		overlayOptions: {
			className: 'text-controls',
			position: 'bottom center',
			relativeTo: 'viewport',
			offsetY: -60
		},
		thumbstrip: {
			position: 'bottom center',
			mode: 'horizontal',
			relativeTo: 'viewport'
		}
	});

	// Cancel the default action for image click and do next instead
	hs.Expander.prototype.onImageClick = function() {
		return hs.next();
	};
</script>