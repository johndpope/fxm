
//
//   ██████╗ ██╗   ██╗███████╗███████╗███████╗██████╗ ███████╗    
//   ██╔══██╗██║   ██║██╔════╝██╔════╝██╔════╝██╔══██╗██╔════╝    
//   ██████╔╝██║   ██║█████╗  █████╗  █████╗  ██████╔╝███████╗    
//   ██╔══██╗██║   ██║██╔══╝  ██╔══╝  ██╔══╝  ██╔══██╗╚════██║    
//   ██████╔╝╚██████╔╝██║     ██║     ███████╗██║  ██║███████║    
//   ╚═════╝  ╚═════╝ ╚═╝     ╚═╝     ╚══════╝╚═╝  ╚═╝╚══════╝    
//************************************************************************************************************
//DOMContentLoaded - Chargement de la page
//	loadBuffers, lister les buffers (names et paths) et créer un objet BufferLoader
//	Dès que BufferLoader est chargé, il appelle sa fct load puis son callback (à la fin du load)
//		sa fct load prend la liste des paths et appelle loadbuffer pour chaque path
//			le loadbuffer prend le path/mp3 et le charge réellement en mémoire
//		finalement sa fct callback fait un tableau des buffers réellement chargés (BUFFERS[name] = buffer)
// -----------------------------------------------------------------------------------------------------------
//loadBuffers
//	BufferLoader
//		load
//			(loop) loadBuffer
//		callback

var loadingPercentage = 0;
var nbOfBuffersLoaded = 0;

// Page-wide audio context.
var context = null;

// Dès que le DOM est chargé, initier le context et le BUFFER
document.addEventListener('DOMContentLoaded', function EVT_DOMContentLoaded() {
	try {
		// Fix up prefixing
		window.AudioContext = window.AudioContext || window.webkitAudioContext;
		context = new AudioContext();
		//alert("test");
		} catch(e) {
		alert("Web Audio API is not supported in this browser");
	}
	
	getParameterByName("bpm");
	
	
	
	buffers_loadBuffers();
});



// Objet listant les buffers à charger en mémoire {name: path}
var BUFFERS_TO_LOAD = {
	
	
	DBA1 : 'sounds/drums/D-BA-1.mp3',
	DBA2 : 'sounds/drums/D-BA-2.mp3',
	DHH1 : 'sounds/drums/D-HH-1.mp3',
	DHH2 : 'sounds/drums/D-HH-2.mp3',
	DHH3 : 'sounds/drums/D-HH-3.mp3',
	DHH4 : 'sounds/drums/D-HH-4.mp3',
	DHH5 : 'sounds/drums/D-HH-5.mp3',
	DHH6 : 'sounds/drums/D-HH-6.mp3',
	DHH7 : 'sounds/drums/D-HH-7.mp3',
	DHH8 : 'sounds/drums/D-HH-8.mp3',
	DSN1 : 'sounds/drums/D-SN-1.mp3',
	DSN2 : 'sounds/drums/D-SN-2.mp3',
	DSTICK: 'sounds/drums/D_STICK.mp3',
	DOHIT:  'sounds/drums/D_OHIT.mp3',
	DRIDE:  'sounds/drums/D_RIDE.mp3',
	DHIGH:  'sounds/drums/D_F-HIGH.mp3',
	DFLOW:  'sounds/drums/D_F-LOW.mp3',
	
	
	/*
		ACN100EN4 : 'sounds/guitar/ACN100EN4.mp3',
		ACN101FN4 : 'sounds/guitar/ACN101FN4.mp3',
		ACN102FD4 : 'sounds/guitar/ACN102FD4.mp3',
		ACN103GN4 : 'sounds/guitar/ACN103GN4.mp3',
		ACN104GD4 : 'sounds/guitar/ACN104GD4.mp3',
		ACN105AN4 : 'sounds/guitar/ACN105AN4.mp3',
		ACN106AD4 : 'sounds/guitar/ACN106AD4.mp3',
		ACN107BN4 : 'sounds/guitar/ACN107BN4.mp3',
		ACN108CN5 : 'sounds/guitar/ACN108CN5.mp3',
		ACN109CD5 : 'sounds/guitar/ACN109CD5.mp3',
		ACN110DN5 : 'sounds/guitar/ACN110DN5.mp3',
		ACN111DD5 : 'sounds/guitar/ACN111DD5.mp3',
		ACN112EN5 : 'sounds/guitar/ACN112EN5.mp3',
		ACN113FN5 : 'sounds/guitar/ACN113FN5.mp3',
		ACN114FD5 : 'sounds/guitar/ACN114FD5.mp3',
		ACN115GN5 : 'sounds/guitar/ACN115GN5.mp3',
		ACN116GD5 : 'sounds/guitar/ACN116GD5.mp3',
		ACN117AN5 : 'sounds/guitar/ACN117AN5.mp3',
		ACN118AD5 : 'sounds/guitar/ACN118AD5.mp3',
		ACN119BN5 : 'sounds/guitar/ACN119BN5.mp3',
		ACN120CN6 : 'sounds/guitar/ACN120CN6.mp3',
		ACN121CD6 : 'sounds/guitar/ACN121CD6.mp3',
		ACN122DN6 : 'sounds/guitar/ACN122DN6.mp3',
		ACN200BN3 : 'sounds/guitar/ACN200BN3.mp3',
		ACN201CN4 : 'sounds/guitar/ACN201CN4.mp3',
		ACN202CD4 : 'sounds/guitar/ACN202CD4.mp3',
		ACN203DN4 : 'sounds/guitar/ACN203DN4.mp3',
		ACN204DD4 : 'sounds/guitar/ACN204DD4.mp3',
		ACN205EN4 : 'sounds/guitar/ACN205EN4.mp3',
		ACN206FN4 : 'sounds/guitar/ACN206FN4.mp3',
		ACN207FD4 : 'sounds/guitar/ACN207FD4.mp3',
		ACN208GN4 : 'sounds/guitar/ACN208GN4.mp3',
		ACN209GD4 : 'sounds/guitar/ACN209GD4.mp3',
		ACN210AN4 : 'sounds/guitar/ACN210AN4.mp3',
		ACN211AD4 : 'sounds/guitar/ACN211AD4.mp3',
		ACN212BN4 : 'sounds/guitar/ACN212BN4.mp3',
		ACN213CN5 : 'sounds/guitar/ACN213CN5.mp3',
		ACN214CD5 : 'sounds/guitar/ACN214CD5.mp3',
		ACN215DN5 : 'sounds/guitar/ACN215DN5.mp3',
		ACN216DD5 : 'sounds/guitar/ACN216DD5.mp3',
		ACN217EN5 : 'sounds/guitar/ACN217EN5.mp3',
		ACN218FN5 : 'sounds/guitar/ACN218FN5.mp3',
		ACN219FD5 : 'sounds/guitar/ACN219FD5.mp3',
		ACN220GN5 : 'sounds/guitar/ACN220GN5.mp3',
		ACN221GD5 : 'sounds/guitar/ACN221GD5.mp3',
		ACN222AN5 : 'sounds/guitar/ACN222AN5.mp3',
		ACN300GN3 : 'sounds/guitar/ACN300GN3.mp3',
		ACN301GD3 : 'sounds/guitar/ACN301GD3.mp3',
		ACN302AN3 : 'sounds/guitar/ACN302AN3.mp3',
		ACN303AD3 : 'sounds/guitar/ACN303AD3.mp3',
		ACN304BN3 : 'sounds/guitar/ACN304BN3.mp3',
		ACN305CN4 : 'sounds/guitar/ACN305CN4.mp3',
		ACN306CD4 : 'sounds/guitar/ACN306CD4.mp3',
		ACN307DN4 : 'sounds/guitar/ACN307DN4.mp3',
		ACN308DD4 : 'sounds/guitar/ACN308DD4.mp3',
		ACN309EN4 : 'sounds/guitar/ACN309EN4.mp3',
		ACN310FN4 : 'sounds/guitar/ACN310FN4.mp3',
		ACN311FD4 : 'sounds/guitar/ACN311FD4.mp3',
		ACN312GN4 : 'sounds/guitar/ACN312GN4.mp3',
		ACN313GD4 : 'sounds/guitar/ACN313GD4.mp3',
		ACN314AN4 : 'sounds/guitar/ACN314AN4.mp3',
		ACN315AD4 : 'sounds/guitar/ACN315AD4.mp3',
		ACN316BN4 : 'sounds/guitar/ACN316BN4.mp3',
		ACN317CN5 : 'sounds/guitar/ACN317CN5.mp3',
		ACN318CD5 : 'sounds/guitar/ACN318CD5.mp3',
		ACN319DN5 : 'sounds/guitar/ACN319DN5.mp3',
		ACN320DD5 : 'sounds/guitar/ACN320DD5.mp3',
		ACN321EN5 : 'sounds/guitar/ACN321EN5.mp3',
		ACN322FN5 : 'sounds/guitar/ACN322FN5.mp3',
		ACN400DN3 : 'sounds/guitar/ACN400DN3.mp3',
		ACN401DD3 : 'sounds/guitar/ACN401DD3.mp3',
		ACN402EN3 : 'sounds/guitar/ACN402EN3.mp3',
		ACN403FN3 : 'sounds/guitar/ACN403FN3.mp3',
		ACN404FD3 : 'sounds/guitar/ACN404FD3.mp3',
		ACN405GN3 : 'sounds/guitar/ACN405GN3.mp3',
		ACN406GD3 : 'sounds/guitar/ACN406GD3.mp3',
		ACN407AN3 : 'sounds/guitar/ACN407AN3.mp3',
		ACN408AD3 : 'sounds/guitar/ACN408AD3.mp3',
		ACN409BN3 : 'sounds/guitar/ACN409BN3.mp3',
		ACN410CN4 : 'sounds/guitar/ACN410CN4.mp3',
		ACN411CD4 : 'sounds/guitar/ACN411CD4.mp3',
		ACN412DN4 : 'sounds/guitar/ACN412DN4.mp3',
		ACN413DD4 : 'sounds/guitar/ACN413DD4.mp3',
		ACN414EN4 : 'sounds/guitar/ACN414EN4.mp3',
		ACN415FN4 : 'sounds/guitar/ACN415FN4.mp3',
		ACN416FD4 : 'sounds/guitar/ACN416FD4.mp3',
		ACN417GN4 : 'sounds/guitar/ACN417GN4.mp3',
		ACN418GD4 : 'sounds/guitar/ACN418GD4.mp3',
		ACN419AN4 : 'sounds/guitar/ACN419AN4.mp3',
		ACN420AD4 : 'sounds/guitar/ACN420AD4.mp3',
		ACN421BN4 : 'sounds/guitar/ACN421BN4.mp3',
		ACN422CN5 : 'sounds/guitar/ACN422CN5.mp3',
		ACN500AN2 : 'sounds/guitar/ACN500AN2.mp3',
		ACN501AD2 : 'sounds/guitar/ACN501AD2.mp3',
		ACN502BN2 : 'sounds/guitar/ACN502BN2.mp3',
		ACN503CN3 : 'sounds/guitar/ACN503CN3.mp3',
		ACN504CD3 : 'sounds/guitar/ACN504CD3.mp3',
		ACN505DN3 : 'sounds/guitar/ACN505DN3.mp3',
		ACN506DD3 : 'sounds/guitar/ACN506DD3.mp3',
		ACN507EN3 : 'sounds/guitar/ACN507EN3.mp3',
		ACN508FN3 : 'sounds/guitar/ACN508FN3.mp3',
		ACN509FD3 : 'sounds/guitar/ACN509FD3.mp3',
		ACN510GN3 : 'sounds/guitar/ACN510GN3.mp3',
		ACN511GD3 : 'sounds/guitar/ACN511GD3.mp3',
		ACN512AN3 : 'sounds/guitar/ACN512AN3.mp3',
		ACN513AD3 : 'sounds/guitar/ACN513AD3.mp3',
		ACN514BN3 : 'sounds/guitar/ACN514BN3.mp3',
		ACN515CN4 : 'sounds/guitar/ACN515CN4.mp3',
		ACN516CD4 : 'sounds/guitar/ACN516CD4.mp3',
		ACN517DN4 : 'sounds/guitar/ACN517DN4.mp3',
		ACN518DD4 : 'sounds/guitar/ACN518DD4.mp3',
		ACN519EN4 : 'sounds/guitar/ACN519EN4.mp3',
		ACN520FN4 : 'sounds/guitar/ACN520FN4.mp3',
		ACN521FD4 : 'sounds/guitar/ACN521FD4.mp3',
		ACN522GN4 : 'sounds/guitar/ACN522GN4.mp3',
		ACN600EN2 : 'sounds/guitar/ACN600EN2.mp3',
		ACN601FN2 : 'sounds/guitar/ACN601FN2.mp3',
		ACN602FD2 : 'sounds/guitar/ACN602FD2.mp3',
		ACN603GN2 : 'sounds/guitar/ACN603GN2.mp3',
		ACN604GD2 : 'sounds/guitar/ACN604GD2.mp3',
		ACN605AN2 : 'sounds/guitar/ACN605AN2.mp3',
		ACN606AD2 : 'sounds/guitar/ACN606AD2.mp3',
		ACN607BN2 : 'sounds/guitar/ACN607BN2.mp3',
		ACN608CN3 : 'sounds/guitar/ACN608CN3.mp3',
		ACN609CD3 : 'sounds/guitar/ACN609CD3.mp3',
		ACN610DN3 : 'sounds/guitar/ACN610DN3.mp3',
		ACN611DD3 : 'sounds/guitar/ACN611DD3.mp3',
		ACN612EN3 : 'sounds/guitar/ACN612EN3.mp3',
		ACN613FN3 : 'sounds/guitar/ACN613FN3.mp3',
		ACN614FD3 : 'sounds/guitar/ACN614FD3.mp3',
		ACN615GN3 : 'sounds/guitar/ACN615GN3.mp3',
		ACN616GD3 : 'sounds/guitar/ACN616GD3.mp3',
		ACN617AN3 : 'sounds/guitar/ACN617AN3.mp3',
		ACN618AD3 : 'sounds/guitar/ACN618AD3.mp3',
		ACN619BN3 : 'sounds/guitar/ACN619BN3.mp3',
		ACN620CN4 : 'sounds/guitar/ACN620CN4.mp3',
		ACN621CD4 : 'sounds/guitar/ACN621CD4.mp3',
		ACN622DN4 : 'sounds/guitar/ACN622DN4.mp3'
	*/
};

// Keep track of all loaded buffers
var names = [];
var paths = [];

var BUFFERS = {}; //Chargé à la toute fin (fct callback) avec les vrais mp3 chargé

// Lister les buffers (names et paths) et créer un objet BufferLoader avec une fct callback qui fera un tableau des buffers réellement chargés
function buffers_loadBuffers() { //trace("FCT", "buffers_loadBuffers");
	names = [];
	paths = [];
	
	
	//trace("07", "BUFFERS SIZE --------------------------------------------------------------------" + Object.keys(BUFFERS).length);
	var cpt = 0;
	// Array-ify	
	for (var name in BUFFERS_TO_LOAD) {
		var path = BUFFERS_TO_LOAD[name];
		if(BUFFERS[name] == null)
		{
			//trace("07", name+"///"+path);
			names.push(name);
			paths.push(path);	
			cpt++;
			
		}
	}	
	
	if(cpt > 0)
	{
		//bufferLoader = new BufferLoader(context, paths, function buffers_callback(bufferList) {
		bufferLoader = new BufferLoader(context, names, function buffers_callback(bufferList) {
			
			//trace("07", "CALLBACK /////////////////////////////////////////////");
			
			for (var i = 0; i < bufferList.length; i++) {
				var buffer = bufferList[i];
				var name = names[i];
				BUFFERS[name] = buffer;			
				//trace("07", "BUFFERS["+name+"] = "+buffer);
				
			}
			
			if(boolLoadBuffer)
			{
				scheduleInstru();
				boolLoadBuffer = false;
			}
			
		});
		bufferLoader.load();
	}
	else
	{
		if(boolLoadBuffer)
		{
			scheduleInstru();
			boolLoadBuffer = false;
		}
	}
}
var boolLoadBuffer = false;
//Objet appelle sa fct load puis son callback (à la fin du load)
function BufferLoader(context, urlList, callback) { //trace("FCT", "BufferLoader");
	this.context = context;
	this.urlList = urlList;
	this.onload = callback;
	this.bufferList = new Array();
	this.loadCount = 0;
}

//Prend la liste des paths et appelle loadbuffer pour chaque path
BufferLoader.prototype.load = function() { //trace("FCT", "BufferLoader.prototype.load");
	for (var i = 0; i < this.urlList.length; ++i)
	{
		this.loadBuffer(this.urlList[i], i);	
	}	
}








//Prend le path/mp3 et le charge en mémoire
BufferLoader.prototype.loadBuffer = function(url, index) { //trace("FCT", "BufferLoader.prototype.loadBuffer");
	
	var loader = this;
	
	/*
		var arrayBuff = Base64Binary.decodeArrayBuffer(soundGUI);
		
		//trace("08", "launching decodeAudioData...");
		
		context.decodeAudioData(arrayBuff, function(audioData) {
		//trace("08", "decodeAudioData OK");
		myBuffer = audioData;
		
	*/
	//trace("07", "base64-to-buffer  OKKKKKKKKKK " + url);
	if(!base64[url]) url = "empty";
	var arrayBuff = Base64Binary.decodeArrayBuffer(base64[url]);
	//console.log(url);
	// Asynchronously decode the audio file data in buffers_request.response		
	loader.context.decodeAudioData(arrayBuff, function buffers_decodeAudioData(buffer) {
		
		/*
			var arrayBuff = Base64Binary.decodeArrayBuffer(sound);
			myAudioContext.decodeAudioData(arrayBuff, function(audioData) {
			myBuffer = audioData;
			}
		*/
		
		
		// on compte le nombre de buffers chargé par rapport au nombre total pour en sortir un %
		
		nbOfBuffersLoaded++;
		loadingPercentage = Math.round(((nbOfBuffersLoaded) / loader.urlList.length)*100);
		if(document.getElementById('loadingPercentage')) {
			document.getElementById('loadingPercentage').innerHTML = "";//loadingPercentage + "%<br/>Loading " + url	;
			if(document.getElementById('progressCharge')) document.getElementById('progressCharge').style.width = loadingPercentage+"%"
			
		}			
		if(loadingPercentage == 100 && document.getElementById('loadingPercentage')) { document.getElementById('loadingPercentage').innerHTML =""; }
		
		if (!buffer) {
			alert('error decoding file data: ' + url);
			return;
		}
		loader.bufferList[index] = buffer;
		if (++loader.loadCount == loader.urlList.length)
		loader.onload(loader.bufferList);
		}, function buffers_log_error(error) {
		console.error('decodeAudioData error', error);
	});
	
	//trace("FCT", "loading..."+url+" >>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>");
	
}







/*
	
	
	
	//Prend le path/mp3 et le charge en mémoire
	BufferLoader.prototype.loadBufferOLD = function(url, index) { //trace("FCT", "BufferLoader.prototype.loadBuffer");
	// Load buffer asynchronously
	var buffers_request = new XMLHttpRequest();
	buffers_request.open("GET", url, true);
	buffers_request.responseType = "arraybuffer";	
	var loader = this;
	
	buffers_request.onload = function() {
	// Asynchronously decode the audio file data in buffers_request.response		
	loader.context.decodeAudioData(buffers_request.response, function buffers_decodeAudioData(buffer) {
	
	
	// on compte le nombre de buffers chargé par rapport au nombre total pour en sortir un %
	
	nbOfBuffersLoaded++;
	loadingPercentage = Math.round(((nbOfBuffersLoaded) / loader.urlList.length)*100);
	if(document.getElementById('loadingPercentage')) {
	document.getElementById('loadingPercentage').innerHTML = "";//loadingPercentage + "%<br/>Loading " + url	;
	if(document.getElementById('progressCharge')) document.getElementById('progressCharge').style.width = loadingPercentage+"%"
	
	}			
	if(loadingPercentage == 100 && document.getElementById('loadingPercentage')) { document.getElementById('loadingPercentage').innerHTML =""; }
	
	if (!buffer) {
	alert('error decoding file data: ' + url);
	return;
	}
	loader.bufferList[index] = buffer;
	if (++loader.loadCount == loader.urlList.length)
	loader.onload(loader.bufferList);
	}, function buffers_log_error(error) {
	console.error('decodeAudioData error', error);
	});
	}
	
	buffers_request.onerror = function() {
	alert('BufferLoader: XHR error');
	}
	buffers_request.send();
	//trace("FCT", "loading..."+url+" >>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>");
	
	}
	
*/
//------------------------------------------------------------------------------
