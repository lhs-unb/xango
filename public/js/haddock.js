$(document).ready(function() {

	/* Todo: criar arquivo de localização */
	var msg = [];
	msg[1] = "Campo obrigatório";
	msg[2] = "Tem certeza que deseja deletar este item? Este é um processo sem volta.";
	msg[3] = "A inserção de novos atributos está bloqueada. Verifique se o cabeçalho do ato foi preenchido ou se há outra atributo que ainda não foi salvo.";
	
	
	
	// Fix da altura da página
	var height = $(document).height();
	
    height -= $('#header').outerHeight();
	height -= $('#footer').outerHeight();
	height -= 37; // numero magico
	
    $('#sidebar').css('height', height);	
	
	// Menu	
	$('.item-menu').click(function() {
		$('.item-menu').removeClass('on');
		$('.menu-container').slideUp('normal');

		if($(this).next().is(':hidden') == true) {
			$(this).addClass('on');
			$(this).next().slideDown('normal');
		}
	});	
	$('.menu-container').hide();
	
	// Tabela de busca
	$(".tabela-busca").stupidtable();
	
	
	$("input[href]").on('click', function() {
		window.location.href = $(this).attr('href');
	});
    
	$.validator.messages.required = msg[1];
	$("form").validate({
		errorClass: "validate_error"
	});
	
	$("[delete='true']").on('click', function() {
		if(confirm(msg[2]))
			return true;
		else
			return false;
	});
	
	$("[lightbox='true']").featherlight({
	});
	
	
	/*
	Modal: 
		doesn't close when you click outside, 
		reloads the page after close, 
		checks if there is non-submitted fields (not disabled)	
	*/
	
	$("[lightbox='modal']").featherlight({
		closeOnClick: 'false',
		beforeClose: function() {
			//console.log('oi');
			//return false;
		},
		afterClose: function() {
			location.reload();
		}
	});
	
});