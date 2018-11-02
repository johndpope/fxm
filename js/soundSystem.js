var loadingPercentage=0;var nbOfBuffersLoaded=0;var context=null;document.addEventListener('DOMContentLoaded',function EVT_DOMContentLoaded(){try{window.AudioContext=window.AudioContext||window.webkitAudioContext;context=new AudioContext()}catch(e){alert("Web Audio API is not supported in this browser")}
getParameterByName("bpm");buffers_loadBuffers()});var BUFFERS_TO_LOAD={DBA1:'sounds/drums/D-BA-1.mp3',DBA2:'sounds/drums/D-BA-2.mp3',DHH1:'sounds/drums/D-HH-1.mp3',DHH2:'sounds/drums/D-HH-2.mp3',DHH3:'sounds/drums/D-HH-3.mp3',DHH4:'sounds/drums/D-HH-4.mp3',DHH5:'sounds/drums/D-HH-5.mp3',DHH6:'sounds/drums/D-HH-6.mp3',DHH7:'sounds/drums/D-HH-7.mp3',DHH8:'sounds/drums/D-HH-8.mp3',DSN1:'sounds/drums/D-SN-1.mp3',DSN2:'sounds/drums/D-SN-2.mp3',DSTICK:'sounds/drums/D_STICK.mp3',DOHIT:'sounds/drums/D_OHIT.mp3',DRIDE:'sounds/drums/D_RIDE.mp3',DHIGH:'sounds/drums/D_F-HIGH.mp3',DFLOW:'sounds/drums/D_F-LOW.mp3',};var names=[];var paths=[];var BUFFERS={};function buffers_loadBuffers(){names=[];paths=[];var cpt=0;for(var name in BUFFERS_TO_LOAD){var path=BUFFERS_TO_LOAD[name];if(BUFFERS[name]==null)
{names.push(name);paths.push(path);cpt++}}
if(cpt>0)
{bufferLoader=new BufferLoader(context,names,function buffers_callback(bufferList){for(var i=0;i<bufferList.length;i++){var buffer=bufferList[i];var name=names[i];BUFFERS[name]=buffer}
if(boolLoadBuffer)
{scheduleInstru();boolLoadBuffer=!1}});bufferLoader.load()}
else{if(boolLoadBuffer)
{scheduleInstru();boolLoadBuffer=!1}}}
var boolLoadBuffer=!1;function BufferLoader(context,urlList,callback){this.context=context;this.urlList=urlList;this.onload=callback;this.bufferList=new Array();this.loadCount=0}
BufferLoader.prototype.load=function(){for(var i=0;i<this.urlList.length;++i)
{this.loadBuffer(this.urlList[i],i)}}
BufferLoader.prototype.loadBuffer=function(url,index){var loader=this;if(!base64[url])url="empty";var arrayBuff=Base64Binary.decodeArrayBuffer(base64[url]);loader.context.decodeAudioData(arrayBuff,function buffers_decodeAudioData(buffer){nbOfBuffersLoaded++;loadingPercentage=Math.round(((nbOfBuffersLoaded)/loader.urlList.length)*100);if(document.getElementById('loadingPercentage')){document.getElementById('loadingPercentage').innerHTML="";if(document.getElementById('progressCharge'))document.getElementById('progressCharge').style.width=loadingPercentage+"%"}
if(loadingPercentage==100&&document.getElementById('loadingPercentage')){document.getElementById('loadingPercentage').innerHTML=""}
if(!buffer){alert('error decoding file data: '+url);return}
loader.bufferList[index]=buffer;if(++loader.loadCount==loader.urlList.length)
loader.onload(loader.bufferList)},function buffers_log_error(error){console.error('decodeAudioData error',error)})}