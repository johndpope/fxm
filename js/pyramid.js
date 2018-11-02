var shadcol='black';var stepEncours=0;var data;var chartCanvas;var chartCanvasCtx;function Pyramid_LineChart(con){this.canvas=document.getElementById(con.canvasId);this.minX=con.minX;this.minY=con.minY;this.maxX=con.maxX;this.maxY=con.maxY;this.unitsPerTickX=con.unitsPerTickX;this.unitsPerTickY=con.unitsPerTickY;this.padding=10;this.tickSize=10;this.axisColor="white";this.pointRadius=3;this.font="10pt Calibri";this.fontHeight=9;this.context=this.canvas.getContext("2d");this.rangeX=this.maxX-this.minX;this.rangeY=this.maxY-this.minY;this.numXTicks=Math.round(this.rangeX/this.unitsPerTickX);this.numYTicks=Math.round(this.rangeY/this.unitsPerTickY);this.x=this.getLongestValueWidth()+this.padding/2;this.y=this.padding*2;this.width=this.canvas.width-this.x-this.padding;this.height=this.canvas.height-this.y-this.padding*2-this.fontHeight;this.scaleX=this.width/this.rangeX;this.scaleY=this.height/this.rangeY;this.drawXAxis();this.drawYAxis()}
Pyramid_LineChart.prototype.getLongestValueWidth=function pyramid_getLongestValueWidth(){this.context.font=this.font;var longestValueWidth=0;for(var n=0;n<=this.numYTicks;n++){var value=this.maxY-(n*this.unitsPerTickY);longestValueWidth=Math.max(longestValueWidth,this.context.measureText(value).width)}
return longestValueWidth};Pyramid_LineChart.prototype.drawXAxis=function pyramid_drawXAxis(){var context=this.context;context.save();context.strokeStyle="#fff ";for(var n=0;n<=this.numXTicks;n++){context.beginPath();context.shadowOffsetY=2;context.shadowBlur=5;context.shadowColor=shadcol;context.moveTo((n)*this.width/this.numXTicks+this.x,this.y+this.height);context.lineTo((n)*this.width/this.numXTicks+this.x,this.y);if(n==0||n==this.numXTicks)
{context.stroke()}
else{if(this.scaleX>9)
{context.stroke()}
else{if(this.scaleX>3)
{if((data[n].x)%5==0)context.stroke()}
else{if(this.scaleX>1)
{if((data[n].x)%10==0)context.stroke()}}}}}
context.beginPath();context.shadowOffsetY=2;context.shadowBlur=5;context.shadowColor=shadcol;context.moveTo(this.x,this.y+this.height);context.lineTo(this.x+this.width,this.y+this.height);context.strokeStyle=this.axisColor;context.lineWidth=3;context.stroke();context.font=this.font;context.fillStyle="white";context.textAlign="center";context.textBaseline="middle";for(var n=0;n<=this.numXTicks;n++){var label=data[n].x;context.save();context.shadowOffsetY=2;context.shadowBlur=5;context.shadowColor=shadcol;context.translate((n)*this.width/this.numXTicks+this.x,this.y+this.height+this.padding);if(label==stepEncours)
{context.fillStyle="white";context.shadowOffsetY=2;context.shadowBlur=5;context.shadowColor="white";context.font="14pt calibri"}
if(this.scaleX>17)
{context.fillText(label,0,0)}
else{if(this.scaleX>9)
{if((data[n].x)%2==0)context.fillText(label,0,11);else context.fillText(label,0,0)}
else{if(this.scaleX>3)
{if((data[n].x)%5==0)context.fillText(label,0,0)}
else{if(this.scaleX>1)
{if((data[n].x)%10==0)context.fillText(label,0,0)}}}}
context.restore()}
context.restore()};Pyramid_LineChart.prototype.drawYAxis=function pyramid_drawYAxis(){var context=this.context;context.save();context.save();context.shadowOffsetY=2;context.shadowBlur=5;context.shadowColor=shadcol;context.shadowOffsetY=2;context.shadowBlur=5;context.shadowColor=shadcol;for(var n=0;n<this.numYTicks;n++){context.beginPath();context.moveTo(this.x,n*this.height/this.numYTicks+this.y);context.lineTo(this.x+this.width,n*this.height/this.numYTicks+this.y);context.strokeStyle="#fff";context.stroke()}
context.beginPath();context.moveTo(this.x,this.y);context.lineTo(this.x,this.y+this.height);context.strokeStyle='white';context.lineWidth=13;context.restore();context.font=this.font;context.fillStyle="white";context.textAlign="right";context.textBaseline="middle";for(var n=0;n<this.numYTicks;n++){var value=Math.round(this.maxY-n*this.unitsPerTickY);context.save();context.shadowOffsetY=2;context.shadowBlur=5;context.shadowColor=shadcol;if(stepEncours>0&&data[stepEncours-1].y==value)
context.fillStyle="white";context.translate(this.x-5,n*this.height/this.numYTicks+this.y);context.fillText(value,0,0);context.restore()}
context.restore()};Pyramid_LineChart.prototype.drawLine=function pyramid_drawLine(data,color,width){var context=this.context;context.save();this.transformContext();context.lineWidth=1;context.strokeStyle=color;context.fillStyle=color;context.shadowOffsetX=0;context.shadowOffsetY=2;context.shadowBlur=5;context.shadowColor=shadcol;context.beginPath();var point=data[0];context.arc((point.x-this.minX)*this.scaleX,(point.y-this.minY)*this.scaleY,this.pointRadius,0,2*Math.PI,!1);context.fill();context.closePath();context.beginPath();context.moveTo(0,(data[0].y-this.minY)*this.scaleY);for(var n=1;n<data.length;n++){point=data[n];context.lineTo((point.x-this.minX)*this.scaleX,(point.y-this.minY)*this.scaleY);context.stroke();context.closePath();context.beginPath();context.arc((point.x-this.minX)*this.scaleX,(point.y-this.minY)*this.scaleY,this.pointRadius,0,2*Math.PI,!1);context.fill();context.closePath();var nToWatch=n-1;if(stepEncours==data[data.length-1].x)nToWatch=n;if(n>0){if(data[nToWatch].x==stepEncours){context.beginPath();context.arc((data[nToWatch].x-this.minX)*this.scaleX,(data[nToWatch].y-this.minY)*this.scaleY,this.pointRadius+4,0,2*Math.PI,!1);context.shadowColor='white';context.shadowOffsetX=0;context.shadowOffsetY=0;context.shadowBlur=20;context.fillStyle='white';context.fill();context.fillStyle=color;context.shadowOffsetX=0;context.shadowOffsetY=2;context.shadowBlur=5;context.shadowColor=shadcol;context.closePath()}}
context.beginPath();context.moveTo((point.x-this.minX)*this.scaleX,(point.y-this.minY)*this.scaleY)}
context.restore()};Pyramid_LineChart.prototype.transformContext=function pyramid_transformContext(){var context=this.context;this.context.translate(this.x,this.y+this.height);context.scale(1,-1)};var magnifyChartDisplayPlus=!0;function pyramid_createChart(){if(document.getElementById("pyramidCanvas"))
{chartCanvas=document.getElementById("pyramidCanvas");chartCanvas.width=document.getElementById('bpmChart').offsetWidth;chartCanvasCtx=chartCanvas.getContext("2d");chartCanvasCtx.clearRect(0,0,chartCanvas.width,chartCanvas.height);var miniY=10;var maxiY=250;if(magnifyChartDisplayPlus)
{miniY=(Math.floor(lowestBpm/10))*10-10;maxiY=(Math.floor(highestBpm/10))*10+10}
var myLineChart=new Pyramid_LineChart({canvasId:"pyramidCanvas",minX:1,minY:miniY,maxX:data.length,maxY:maxiY,unitsPerTickX:1,unitsPerTickY:10});myLineChart.drawLine(data,"white",1)}};var highestBpm;var lowestBpm;var totals=0;function pyramid_updatePyramid(){if(document.getElementById("pyramidCanvas"))
{data=new Array();sommetBpm=parseInt(sommetBpm);departBpm=parseInt(departBpm);cibleBpm=parseInt(cibleBpm);sommetStep=parseInt(sommetStep);departStep=parseInt(departStep);cibleStep=parseInt(cibleStep);nbSteps=parseInt(nbSteps);highestBpm=departBpm;if(cibleBpm>highestBpm)highestBpm=cibleBpm;if((pyramidType==""||pyramidType=="pyramidal")&&sommetBpm>highestBpm)highestBpm=sommetBpm;lowestBpm=departBpm;if(cibleBpm<lowestBpm)lowestBpm=cibleBpm;if((pyramidType==""||pyramidType=="pyramidal")&&sommetBpm<lowestBpm)lowestBpm=sommetBpm;if(pyramidType=="")
{var y=departBpm;for(i=1;i<=departStep;i++){data.push({x:i,y:departBpm})}
var step=(sommetBpm-departBpm)/(sommetStep-departStep);for(i=departStep+1;i<=sommetStep;i++){y+=step;data.push({x:i,y:(Math.round(y))})}
step=(cibleBpm-sommetBpm)/(cibleStep-sommetStep);for(i=sommetStep+1;i<cibleStep;i++){y+=step;data.push({x:i,y:(Math.round(y))})}
for(i=cibleStep;i<=nbSteps;i++){data.push({x:i,y:cibleBpm})}}
if(pyramidType=="P")
{var y=departBpm;var step=(cibleBpm-departBpm)/(nbSteps-1);for(i=1;i<=nbSteps;i++){data.push({x:i,y:(Math.round(y))});y+=step}}
if(pyramidType=="S")
{var step=0;for(i=1;i<=nbSteps;i++){data.push({x:i,y:parseInt(document.getElementById("staticBpm").value)})}}
pyramid_createChart();totals=0;var bpm=0;var mesCpt=4;if(ternaire)mesCpt=3;for(i=0;i<data.length;i++){bpm=data[i].y;var nbDeBPMparSec=bpm/60;var uneMes=mesCpt/nbDeBPMparSec;var nbmes;nbmes=parseInt(nbMesures);if(transition)nbmes++;else{if(i==0)nbmes++}
totals+=uneMes*nbmes}
if(!dontUpdateChrono)
{minu=Math.floor(totals/60);secon=Math.floor(totals-minu*60);chrono=(minu*60)+secon;totals=0;bpm=0;if(stepEncours>0)
{for(i=stepEncours-1;i<data.length;i++){bpm=data[i].y;var nbDeBPMparSec=bpm/60;var uneMes=mesCpt/nbDeBPMparSec;var nbmes;nbmes=parseInt(nbMesures);if(transition)nbmes++;else{if(i==0)nbmes++}
totals+=uneMes*nbmes}
minu=Math.floor(totals/60);secon=Math.floor(totals-minu*60);chronoCourant=(minu*60)+secon}
else{chronoCourant=chrono}
updateTimeBar()}
if(stepEncours>0)
{if(document.getElementById("bpmCourant")&&bpm>0)document.getElementById("bpmCourant").innerHTML=data[stepEncours-1].y}
else{if(document.getElementById("bpmCourant"))document.getElementById("bpmCourant").innerHTML=""}}}
function pyramid_EVT_departStep(val)
{if(val>0)
{departStep=parseInt(val);if(departStep<=0)departStep=1;if(departStep>99)departStep=99;if(departStep>=sommetStep)sommetStep=departStep+1;if(sommetStep>=cibleStep)cibleStep=sommetStep+1;if(cibleStep>nbSteps)nbSteps=cibleStep;document.getElementById('sommetStep').value=sommetStep;document.getElementById('cibleStep').value=cibleStep;document.getElementById('nbSteps').value=nbSteps;document.getElementById('departStep').value=departStep}
else{document.getElementById('departStep').value=1;departStep=1}
pyramid_updatePyramid()}
if(document.getElementById('departStep')){document.getElementById('departStep').addEventListener('change',function pyramid_EVT_departStep_change(){pyramid_EVT_departStep(this.value)})}
function pyramid_EVT_sommetStep(val)
{if(val>0)sommetStep=parseInt(val);if(sommetStep<=0)sommetStep=1;if(sommetStep>99)sommetStep=99;if(sommetStep<=departStep)
{if(departStep>1)departStep=sommetStep-1;else sommetStep=departStep+1}
if(sommetStep>=cibleStep)cibleStep=sommetStep+1;if(cibleStep>nbSteps)nbSteps=cibleStep;document.getElementById('departStep').value=departStep;document.getElementById('cibleStep').value=cibleStep;document.getElementById('nbSteps').value=nbSteps;document.getElementById('sommetStep').value=sommetStep;pyramid_updatePyramid()}
if(document.getElementById('sommetStep')){document.getElementById('sommetStep').addEventListener('change',function pyramid_EVT_sommetStep_change(){pyramid_EVT_sommetStep(this.value)})}
function pyramid_EVT_cibleStep(val)
{if(val>0)cibleStep=parseInt(val);if(cibleStep<=0)cibleStep=1;if(cibleStep>99)cibleStep=99;if(cibleStep<=sommetStep)sommetStep=cibleStep-1;if(sommetStep<=departStep)
{if(departStep>1)
{departStep=sommetStep-1}
else{sommetStep=departStep+1;cibleStep=sommetStep+1}}
if(cibleStep>nbSteps)nbSteps=cibleStep;document.getElementById('departStep').value=departStep;document.getElementById('cibleStep').value=cibleStep;document.getElementById('sommetStep').value=sommetStep;document.getElementById('nbSteps').value=nbSteps;pyramid_updatePyramid()}
if(document.getElementById('cibleStep')){document.getElementById('cibleStep').addEventListener('change',function pyramid_EVT_cibleStep_change(){pyramid_EVT_cibleStep(this.value);RhythmSample.stop()})}
function pyramid_EVT_nbSteps(val)
{if(val>2)nbSteps=parseInt(val);if(nbSteps<=0)nbSteps=1;if(nbSteps>50)nbSteps=99;if(nbSteps<=cibleStep)
{cibleStep=nbSteps}
if(cibleStep<=sommetStep)sommetStep=cibleStep-1;if(sommetStep<=departStep)
{if(departStep>1)
{departStep=sommetStep-1}
else{sommetStep=departStep+1;cibleStep=sommetStep+1}}
if(cibleStep>nbSteps)nbSteps=cibleStep;document.getElementById('departStep').value=departStep;document.getElementById('cibleStep').value=cibleStep;document.getElementById('sommetStep').value=sommetStep;document.getElementById('nbSteps').value=nbSteps;pyramid_updatePyramid();pyramid_updatePyramid()}
if(document.getElementById('nbSteps')){document.getElementById('nbSteps').addEventListener('change',function pyramid_EVT_nbSteps_change(){pyramid_EVT_nbSteps(this.value);RhythmSample.stop()})}
function pyramid_EVT_nbMesures(val)
{if(val<=0)val=1;if(val>50)val=50;nbMesures=val;bars=val;document.getElementById('nbMesures').value=nbMesures;pyramid_updatePyramid()}
if(document.getElementById('nbMesures')){document.getElementById('nbMesures').addEventListener('change',function pyramid_EVT_nbMesures_change(){pyramid_EVT_nbMesures(this.value)})}
if(document.getElementById('pyramidAllUp')){document.getElementById('pyramidAllUp').addEventListener('click',function pyramid_EVT_pyramidAllUp(){cibleBpm=cibleBpm+5;sommetBpm=sommetBpm+5;departBpm=departBpm+5;pyramid_updatePyramid();pyramid_EVT_cibleBpm(cibleBpm);pyramid_EVT_sommetBpm(sommetBpm);pyramid_EVT_departBpm(departBpm);RhythmSample.stop()})}
if(document.getElementById('pyramidAllDown')){document.getElementById('pyramidAllDown').addEventListener('click',function pyramid_EVT_pyramidAllDown(){cibleBpm=cibleBpm-5;sommetBpm=sommetBpm-5;departBpm=departBpm-5;pyramid_EVT_cibleBpm(cibleBpm);pyramid_EVT_sommetBpm(sommetBpm);pyramid_EVT_departBpm(departBpm);pyramid_updatePyramid();RhythmSample.stop()})}
if(document.getElementById('magnifyChartMinus')){document.getElementById('magnifyChartMinus').addEventListener('click',function pyramid_EVT_magnifyChartMinus(){magnifyChartDisplayPlus=!1;document.getElementById('magnifyChartMinus').style.display='none';document.getElementById('magnifyChartPlus').style.display='block';pyramid_updatePyramid()})}
if(document.getElementById('magnifyChartPlus')){document.getElementById('magnifyChartPlus').addEventListener('click',function pyramid_EVT_magnifyChartPlus(){magnifyChartDisplayPlus=!0;document.getElementById('magnifyChartMinus').style.display='block';document.getElementById('magnifyChartPlus').style.display='none';pyramid_updatePyramid()})}
if(document.getElementById('cibleBpm'))document.getElementById('cibleBpm').value=parseInt(document.getElementById('cibleBpm').value);pyramid_updatePyramid();if(document.getElementById('departStepUp')){document.getElementById('departStepUp').addEventListener('click',function pyramid_EVT_departStepUp(){document.getElementById('departStep').value=parseInt(document.getElementById('departStep').value)+1;pyramid_EVT_departStep(document.getElementById('departStep').value);pyramid_updatePyramid();RhythmSample.stop()})}
if(document.getElementById('sommetStepUp')){document.getElementById('sommetStepUp').addEventListener('click',function pyramid_EVT_departStepUp(){document.getElementById('sommetStep').value=parseInt(document.getElementById('sommetStep').value)+1;pyramid_EVT_sommetStep(document.getElementById('sommetStep').value);pyramid_updatePyramid();RhythmSample.stop()})}
if(document.getElementById('cibleStepUp')){document.getElementById('cibleStepUp').addEventListener('click',function pyramid_EVT_departStepUp(){document.getElementById('cibleStep').value=parseInt(document.getElementById('cibleStep').value)+1;pyramid_EVT_cibleStep(document.getElementById('cibleStep').value);pyramid_updatePyramid();RhythmSample.stop()})}
if(document.getElementById('departStepDown')){document.getElementById('departStepDown').addEventListener('click',function pyramid_EVT_departStepDown(){document.getElementById('departStep').value=parseInt(document.getElementById('departStep').value)-1;pyramid_EVT_departStep(document.getElementById('departStep').value);pyramid_updatePyramid();RhythmSample.stop()})}
if(document.getElementById('sommetStepDown')){document.getElementById('sommetStepDown').addEventListener('click',function pyramid_EVT_departStepDown(){document.getElementById('sommetStep').value=parseInt(document.getElementById('sommetStep').value)-1;pyramid_EVT_sommetStep(document.getElementById('sommetStep').value);pyramid_updatePyramid();RhythmSample.stop()})}
if(document.getElementById('cibleStepDown')){document.getElementById('cibleStepDown').addEventListener('click',function pyramid_EVT_departStepDown(){document.getElementById('cibleStep').value=parseInt(document.getElementById('cibleStep').value)-1;pyramid_EVT_cibleStep(document.getElementById('cibleStep').value);pyramid_updatePyramid();RhythmSample.stop()})}
if(document.getElementById('nbStepsUp')){document.getElementById('nbStepsUp').addEventListener('click',function pyramid_EVT_nbStepsUp(){document.getElementById('nbSteps').value=parseInt(document.getElementById('nbSteps').value)+1;pyramid_EVT_nbSteps(document.getElementById('nbSteps').value);pyramid_updatePyramid();RhythmSample.stop()})}
if(document.getElementById('nbStepsDown')){document.getElementById('nbStepsDown').addEventListener('click',function pyramid_EVT_nbStepsDown(){document.getElementById('nbSteps').value=parseInt(document.getElementById('nbSteps').value)-1;pyramid_EVT_nbSteps(document.getElementById('nbSteps').value);pyramid_updatePyramid();RhythmSample.stop()})}
if(document.getElementById('nbMesuresUp')){document.getElementById('nbMesuresUp').addEventListener('click',function pyramid_EVT_nbMesuresUp(){document.getElementById('nbMesures').value=parseInt(document.getElementById('nbMesures').value)+1;pyramid_EVT_nbMesures(document.getElementById('nbMesures').value);pyramid_updatePyramid();RhythmSample.stop()})}
if(document.getElementById('nbMesuresDown')){document.getElementById('nbMesuresDown').addEventListener('click',function pyramid_EVT_nbMesuresDown(){document.getElementById('nbMesures').value=parseInt(document.getElementById('nbMesures').value)-1;pyramid_EVT_nbMesures(document.getElementById('nbMesures').value);pyramid_updatePyramid();RhythmSample.stop()})}
if(document.getElementById('departBpmUp')){document.getElementById('departBpmUp').addEventListener('click',function pyramid_EVT_departBpmUp(){document.getElementById('departBpm').value=parseInt(document.getElementById('departBpm').value)+5;pyramid_EVT_departBpm(document.getElementById('departBpm').value);pyramid_updatePyramid();RhythmSample.stop()})}
if(document.getElementById('sommetBpmUp')){document.getElementById('sommetBpmUp').addEventListener('click',function pyramid_EVT_departBpmUp(){document.getElementById('sommetBpm').value=parseInt(document.getElementById('sommetBpm').value)+5;pyramid_EVT_sommetBpm(document.getElementById('sommetBpm').value);pyramid_updatePyramid();RhythmSample.stop()})}
if(document.getElementById('cibleBpmUp')){document.getElementById('cibleBpmUp').addEventListener('click',function pyramid_EVT_departBpmUp(){document.getElementById('cibleBpm').value=parseInt(document.getElementById('cibleBpm').value)+5;pyramid_EVT_cibleBpm(document.getElementById('cibleBpm').value);pyramid_updatePyramid();RhythmSample.stop()})}
if(document.getElementById('departBpmDown')){document.getElementById('departBpmDown').addEventListener('click',function pyramid_EVT_departBpmDown(){document.getElementById('departBpm').value=parseInt(document.getElementById('departBpm').value)-5;pyramid_EVT_departBpm(document.getElementById('departBpm').value);pyramid_updatePyramid();RhythmSample.stop()})}
if(document.getElementById('sommetBpmDown')){document.getElementById('sommetBpmDown').addEventListener('click',function pyramid_EVT_departBpmDown(){document.getElementById('sommetBpm').value=parseInt(document.getElementById('sommetBpm').value)-5;pyramid_EVT_sommetBpm(document.getElementById('sommetBpm').value);pyramid_updatePyramid();RhythmSample.stop()})}
if(document.getElementById('cibleBpmDown')){document.getElementById('cibleBpmDown').addEventListener('click',function pyramid_EVT_departBpmDown(){document.getElementById('cibleBpm').value=parseInt(document.getElementById('cibleBpm').value)-5;pyramid_EVT_cibleBpm(document.getElementById('cibleBpm').value);pyramid_updatePyramid();RhythmSample.stop()})}
if(document.getElementById('bpmDown')){document.getElementById('bpmDown').addEventListener('click',function bpm_EVT_bpmDown(){bpm_EVT_bpm(parseInt(document.getElementById('bpm').value)-5);document.getElementById('bpm').value=bpm;pyramid_updatePyramid();RhythmSample.stop()})}
if(document.getElementById('bpmUp')){document.getElementById('bpmUp').addEventListener('click',function bpm_EVT_bpmUp(){bpm_EVT_bpm(parseInt(document.getElementById('bpm').value)+5);document.getElementById('bpm').value=bpm;pyramid_updatePyramid();RhythmSample.stop()})}
if(document.getElementById('staticBpm')){document.getElementById('staticBpm').addEventListener('change',function pyramid_EVT_departBpm_change(){document.getElementById('staticBpm').value=setBPMLimit(document.getElementById('staticBpm').value);pyramid_updatePyramid();RhythmSample.stop()})}
if(document.getElementById('staticBpmUp')){document.getElementById('staticBpmUp').addEventListener('click',function pyramid_EVT_staticBpmUp(){document.getElementById('staticBpm').value=parseInt(document.getElementById('staticBpm').value)+5;document.getElementById('staticBpm').value=setBPMLimit(document.getElementById('staticBpm').value);pyramid_updatePyramid();RhythmSample.stop()})}
if(document.getElementById('staticBpmDown')){document.getElementById('staticBpmDown').addEventListener('click',function pyramid_EVT_departBpmDown(){document.getElementById('staticBpm').value=parseInt(document.getElementById('staticBpm').value)-5;document.getElementById('staticBpm').value=setBPMLimit(document.getElementById('staticBpm').value);pyramid_updatePyramid();RhythmSample.stop()})}
function pyramid_EVT_departBpm(val)
{departBpm=document.getElementById('departBpm').value=setBPMLimit(val);pyramid_updatePyramid()}
if(document.getElementById('departBpm')){document.getElementById('departBpm').addEventListener('change',function pyramid_EVT_departBpm_change(){pyramid_EVT_departBpm(this.value)})}
function pyramid_EVT_sommetBpm(val)
{sommetBpm=document.getElementById('sommetBpm').value=setBPMLimit(val);pyramid_updatePyramid()}
if(document.getElementById('sommetBpm')){document.getElementById('sommetBpm').addEventListener('change',function pyramid_EVT_sommetBpm_change(){pyramid_EVT_sommetBpm(this.value)})}
function pyramid_EVT_cibleBpm(val)
{cibleBpm=document.getElementById('cibleBpm').value=setBPMLimit(val);pyramid_updatePyramid()}
if(document.getElementById('cibleBpm')){document.getElementById('cibleBpm').addEventListener('change',function pyramid_EVT_cibleBpm_change(){pyramid_EVT_cibleBpm(this.value)})}
function transitionCheckChange(check){if(document.getElementById('transitionCheck').checked)
{transition=!0}
else{transition=!1}
pyramid_updatePyramid();RhythmSample.stop()}
function signatureTypeChange(radio){RhythmSample.stop();if(radio.value=="34")
{ternaire=!0;document.getElementById('drumSound').style.display="none";document.getElementById('drumSoundTernaire').style.display="block"}
else{ternaire=!1;document.getElementById('drumSound').style.display="block";document.getElementById('drumSoundTernaire').style.display="none"}
pyramid_updatePyramid()}
var rustineStepDisplay="";function metronomeTypeChange(radio){pyramidType="";RhythmSample.stop();if(radio=="static")
{pyramidType="S";document.getElementById('transition').style.display="none";document.getElementById('bpmChart').style.display="none";document.getElementById('bpmStatic').style.display="block";if(document.getElementById('remainingTime'))document.getElementById('remainingTime').style.display="none";if(document.getElementById('progressTime2'))document.getElementById('progressTime2').style.display="none"}
else{document.getElementById('transition').style.display="block";document.getElementById('bpmChart').style.display="block";document.getElementById('bpmStatic').style.display="none";if(document.getElementById('remainingTime'))document.getElementById('remainingTime').style.display="block";if(document.getElementById('progressTime2'))document.getElementById('progressTime2').style.display="block";if(document.getElementById('progressTime2')&&document.getElementById('miniTime').style.display!="none")document.getElementById('progressTime2').style.display="block"}
if(radio=="progressive")
{pyramidType="P";document.getElementById('sommet').style.display="none";if(document.getElementById('stepBPMTDHead1').innerHTML!="")rustineStepDisplay=document.getElementById('stepBPMTDHead1').innerHTML;document.getElementById('stepBPMTDHead1').innerHTML="";document.getElementById('sommetStepTD').style.display="none";document.getElementById('sommetBpmTD').style.display="none";document.getElementById('departStepTD').style.display="none";document.getElementById('cibleStepTD').style.display="none"}
if(radio==""||radio=="pyramidal")
{pyramidType="";document.getElementById('sommet').style.display="table-cell";if(rustineStepDisplay!="")document.getElementById('stepBPMTDHead1').innerHTML=rustineStepDisplay;document.getElementById('sommetStepTD').style.display="table-cell";document.getElementById('sommetBpmTD').style.display="table-cell";document.getElementById('departStepTD').style.display="table-cell";document.getElementById('cibleStepTD').style.display="table-cell"}
pyramid_updatePyramid()}