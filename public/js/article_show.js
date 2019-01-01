$(document).ready(function(){
	$('.js-like-article').on('click', function(e) {
		e.preventDefault();

		var $link = $(e.currentTarget);
		$link.toggleClass('fa-heart-o').toggleClass('fa-heart');

		$.ajax({
			method: 'POST',
			url: $link.attr('href')
		}).done(function(data){
			$('.js-like-article-count').html(data.hearts);
			var url = $link.attr('href');
			if(url.includes('/heart')) {
				$link.attr("href", url.replace("/heart","/unheart"));
			} else {
				$link.attr("href", url.replace("/unheart","/heart"));
			}
		});
	});
});