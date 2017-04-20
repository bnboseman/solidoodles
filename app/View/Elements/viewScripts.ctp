<script type="text/javascript">
	function windowpop(url, width, height) {
	    var leftPosition, topPosition;
	    //Allow for borders.
	    leftPosition = (window.screen.width / 2) - ((width / 2) + 10);
	    //Allow for title and status bars.
	    topPosition = (window.screen.height / 2) - ((height / 2) + 50);
	    //Open the window.
	    window.open(url, "Window2", "status=no,height=" + height + ",width=" + width + ",resizable=yes,left=" + leftPosition + ",top=" + topPosition + ",screenX=" + leftPosition + ",screenY=" + topPosition + ",toolbar=no,menubar=no,scrollbars=no,location=no,directories=no");
	}
	
	function pictureprimary(picture, filename, id){
		$.post(
			"pictureprimary", 
			{picture: picture, solidoodle: solidoodle, user: user, id: id, filename: filename});
		$.post(
			"pictureload", 
			{solidoodle: solidoodle, user: user}, 
			function(data){ $('#soliholder').attr(
				'src', data.data.default_picture);}, 'json');
	}

	$( document ).ready(function () {
		
		$.ajax({
			async: true,
			success: function (data, textStatus) {
				$("#doodle").html(data);
			},
			url:"\/doodles\/viewer\/" + $('#doodle').attr("doodle-id")
		});
		
		$("#social-button a").click( function (event) {
			event.preventDefault();
			 windowpop($(this).attr("href"), 600, 400);
		});
		$("#CommentComment").tooltip({
			title: "Please leave a comment longer than 5 letters",
			placement: "top",
			animation: true,
			trigger: "manual"
		});
		$("#CommentComment").blur( function () {
			var comment = $("#CommentComment").val();
			if(comment.length < 6) {
				$("#CommentComment").tooltip('show')
					.addClass("has-error");
			} else {
				$("#CommentComment").tooltip('hide')
					.removeClass("has-error");
			}
		});
		$("#CommentComment").focus( function () {
			$("#CommentComment").tooltip('hide')
				.removeClass("has-error");
		});
		$("#ajaxCommentForm").submit( function () {
			var comment = $("#CommentComment").val();
			if(comment.length > 5) {
				$.ajax({
					async: true,
					dataType: "html",
					data: <?php echo $this->Js->get('#ajaxCommentForm')->serializeForm(array('isForm' => true, 'inline' => true)); ?>,
					success: function (data, textStatus) {
						$("#commentsection").html(data);
					},
					type:"POST",
					url:"\/comments\/add"
				});
				$("#CommentComment").val("");
			}
		});	

		
		$("#doodle-carousel").on('slid.bs.carousel', function (e) {
			var slideToModify = $(this).find('.carouselItem.active');
			if (slideToModify !== 0 && slideToModify.find('#soliviewer').length === 0 && slideToModify.attr("noSoliviewer") === undefined) {
				soliview(slideToModify.attr("doodleId"), "https://s3.amazonaws.com/solidoodles/<?php echo $model['id']; ?>/" + slideToModify.attr("doodleModel"));
			}
		});
		$('#doodle-carousel').carousel();
		$('#doodle-carousel').on('slid.bs.carousel', function () {
			var to_slide = $('.carousel-inner .carouselItem.active').attr('index');
			$('.carousel-indicators').children().removeClass('active');
			$('.carousel-indicators li[data-slide-to='+ to_slide +']').addClass('active');
		});
		$(".picture-wrap").click(function () {
			if (!($(this).hasClass("primary-picture"))) {
				pictureprimary($(this).attr("picture"), $(this).attr("filename"), $(this).attr("picture-id"));
				$(".picture-highlight-wrap").removeClass("primary-picture");
				$(this).parent().addClass("primary-picture");
				$.ajax({
	              url: "/picture/select/" + $(this).attr("picture-id"),
	              context: document.body
	            }).done(function() {
	              $( this ).addClass( "done" );
	            });
			}
		});
		$(".delete-img").click(function (e) {
			e.preventDefault();
			e.stopPropagation();
			var divClicked = $(this);
			$.post("deletepicture", 
				{"doodleId": $(this).attr("doodle-id"), "id": $(this).attr("picture-id")},
				function () {
					divClicked.closest(".col-md-2").remove();
					if ( !($(".picture-highlight-wrap").hasClass("primary-picture")) ) {
						$(".picture-wrap").first().trigger('click');
					}	
				}
			);
		});

		$('#CommentComment').val(''); 
		
		$('#addpictures').click( function(){
			$('#dialog').dialog({
				width: 400,
				modal: true
			});
		});
		$('#editMyDoodle').click( function(){
			$('#editMyDoodleDialog').dialog({
				width: 400,
				modal: true
			});
		});
		$('#individualModels').click( function(){
			$('#individualModelsModal').dialog({
				width: 400,
				modal: true
			});
		});
		$('#closeIndividualModelsModal').click( function() {
			$('#individualModelsModal').dialog().dialog("close");
		});
		$('#closeModal').click( function(){
			$('#dialog').dialog("close");
		});
		$('#closeEditMyDoodle').click( function() {
			$('#editMyDoodleDialog').dialog("close");
		});
		$("#like").click( function(){
			$.post("like",{upload_id: solidoodle, user_id: user});
			$("#like").addClass("glow-green");
			$('#like > .text').text('Liked!');
		});
		$(".download-btn").click( function(){
			$.ajax({
				async: false,
				dataType: "html",
				data: {id: solidoodle},
				success: function (data, textStatus) {
					$("#downloadsCount").html(data);
				},
				type:"POST",
				url:"\/models\/download"
			});
		});
		$(".downloadButton").click( function(){
			$.ajax({
				async: true,
				dataType: "html",
				data: {id: solidoodle},
				success: function (data, textStatus) {
					$("#downloadsCount").html(data);
				},
				type:"POST",
				url:"\/models\/download"
			});
		});
	});	
</script>