$(document).ready(function(){
	$('#input-from-location').bind('keyup',function(){
		suggestLocation($('#input-from-location').val(),1);
	});
	$('#input-to-location').bind('keyup',function(){
		suggestLocation($('#input-to-location').val(),2);
	});
	var c = ( ( $(window).height() - $('body').height() ) / 2 ) - 20;
	$('#form-error').css({marginTop:c+'px'});
	if( $('#splash-outer-wrapper').length > 0 ){
		$('#splash-outer-wrapper').css({marginTop:c+'px'});
	}
	
	if( $('#results-outer-wrapper').length > 0 ){
		$('body').css('overflow', 'hidden');
	}
	
});

function formValidate(){
	
	var validation = true;
	var target = $('#form-error');
	
	
	var vObject = new Validator();
	console.log(vObject);
	vObject.validate('input-from-location',$('#input-from-location').val(),{'required':''});
	vObject.validate('input-to-location',$('#input-to-location').val(),{'required':''});
	vObject.validate('input-date-departure',$('#input-date-departure').val(),{'required':''});
	vObject.validate('input-date-arrival',$('#input-date-arrival').val(),{'required':''});
	if(vObject.result==false){
		validation = false;
		target.html('An error occured during submission. Please see highlighted fields.');
		target.css('color','red');
		target.show();
	}
	
	return validation;
}

function suggestLocation(q,a){
	$.ajax({
		type: 'POST',
		url: 'index.php',
		data: {ajax_call:1, ajax_proc:'apsuggest', query: q},
		dataType: 'json'
	}).done(function(response){
		var s = '<ul>';
		$.each(response.airports,function(i,v){
			s += '<li><a onclick="putSuggestion(\''+v+'\', \''+i+'\', '+a+')">'+v+' ('+i+')</a></li>';
		});
		s += '</ul>';
		if(a==1){
			$('#div-location-suggest-from').html();
			$('#div-location-suggest-from').html(s);
			$('#div-location-suggest-from').show();
		}else{
			$('#div-location-suggest-to').html();
			$('#div-location-suggest-to').html(s);
			$('#div-location-suggest-to').show();
		}
	});
}

function putSuggestion(a,b,c){
	if(c==1){
		$('#input-from-location').val(a+' ('+b+')');
		$('#div-location-suggest-from').hide();
	}else{
		$('#input-to-location').val(a+' ('+b+')');
		$('#div-location-suggest-to').hide();
	}
}

function showCalendar(o){
	$('#'+o).glDatePicker();		
}

function redir(){
	window.location.href="http://localhost/results.php";
}