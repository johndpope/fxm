(function($){$.fn.notif=function(options){var settings={html:'<div class="notification animated fadeInLeft {{cls}}">\
			<div class="left">\
			<div class="">\
			{{{icon}}}\
			</div>\
			</div>\
			<div class="right">\
			<h2>{{title}}</h2>\
			<p>{{content}}</p>\
			</div>\
			</div>',icon:'&#128077;',timeout:!1}
if(options.cls=='error')
{settings.icon='<img alt="Error" src="images/notifKo.png" class="icon"/>'}
if(options.cls=='success')
{settings.icon='<img alt="Success" src="images/notifOk.png" class="icon"/>'}
var options=$.extend(settings,options);return this.each(function(){var $this=$(this);var $notifs=$('> .notifications',this);var $notif=$(Mustache.render(options.html,options));if($notifs.length==0){$notifs=$('<div class="notifications"/>');$this.append($notifs)}
$notifs.append($notif);if(options.timeout){setTimeout(function(){$notif.trigger('click')},options.timeout)}
$notif.click(function(event){event.preventDefault();$notif.addClass('fadeOutLeft').delay(500).slideUp(300,function(){if($notif.siblings().length==0){$notifs.remove()}
$notif.remove()})})})}})(jQuery)