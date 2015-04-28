var comingsoon = {
	_init : function() {
		$('form#fi-subscribe').bind('submit', function(e){
			e.preventDefault();
			$.ajax({
			  method: "POST",
			  url: "/ficomingsoon/includes/comingsoon.php?email=" + $('#fi-email').val()
			})
	  		.done(function( msg ) {
				console.log(msg);
				$('#fi-subscribe > p.error').remove();

				if(msg && msg.code == 400) {
					$('#fi-email').after("<p class='error'>Votre adresse email existe déjà dans notre base.</p>")
				} else if (msg && msg.code == 200) {
	  				$('form').hide();
	  				var fiemail = $("#fi-email").val();
	  				$('.fi-saved-email').text(fiemail);
	   				$('.fi-thanks').show();
				}
	  		})
	  		.fail(function() {
	  			$('#fi-email').after("<p class='error'>Nous sommes désolés, il y a une erreur interne.<br/> Veuillez réessayer plus tard.</p>")
	  		});
		});
	}
};
$(document).ready(function(){
	comingsoon._init();
})
