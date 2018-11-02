
var glRaf;
var active = true;

function guitarListener()
{
 ! function e(t, n, r) {
    function s(o, u) {
        if (!n[o]) {
            if (!t[o]) {
                var a = "function" == typeof require && require;
                if (!u && a) return a(o, !0);
                if (i) return i(o, !0);
                var f = new Error("Cannot find module '" + o + "'");
                throw f.code = "MODULE_NOT_FOUND", f
            }
            var l = n[o] = {
                exports: {}
            };
            t[o][0].call(l.exports, function(e) {
                var n = t[o][1][e];
                return s(n ? n : e)
            }, l, l.exports, e, t, n, r)
        }
        return n[o].exports
    }
    for (var i = "function" == typeof require && require, o = 0; o < r.length; o++) s(r[o]);
        return s
}({
    1: [function(require, module, exports) {
        "use strict";

        function _interopRequireDefault(obj) {
            return obj && obj.__esModule ? obj : {
                "default": obj
            }
        }

        function _classCallCheck(instance, Constructor) {
            if (!(instance instanceof Constructor)) throw new TypeError("Cannot call a class as a function")
        }
    Object.defineProperty(exports, "__esModule", {
        value: !0
    });
    var _createClass = function() {
        function defineProperties(target, props) {
            for (var i = 0; i < props.length; i++) {
                var descriptor = props[i];
                descriptor.enumerable = descriptor.enumerable || !1, descriptor.configurable = !0, "value" in descriptor && (descriptor.writable = !0), Object.defineProperty(target, descriptor.key, descriptor)
            }
        }
        return function(Constructor, protoProps, staticProps) {
            return protoProps && defineProperties(Constructor.prototype, protoProps), staticProps && defineProperties(Constructor, staticProps), Constructor
        }
    }(),
    _TuningModel = require("./TuningModel"),
    _TuningModel2 = _interopRequireDefault(_TuningModel),
    _YinPitchEstimationModel = require("./YinPitchEstimationModel"),
    _YinPitchEstimationModel2 = _interopRequireDefault(_YinPitchEstimationModel),
    TunerInputModel = function() {
        function TunerInputModel(view) {
            //1console.log(_YinPitchEstimationModel);
            _classCallCheck(this,TunerInputModel),
            this.view = view,
            this.Yin = new _YinPitchEstimationModel2["default"],
            this.tuning_name = "Standard",
            this.tuning = new _TuningModel2["default"],
            this.useSPP = !1,
            this.useAC = !1,
            this.useYin = !0,
            this.volumeThreshold = 134,
            this.nPitchValues = 5,
            this.audioContext = null,
            this.analyserNode = null,
            this.processNode = null,
            this.microphoneNode = null,
            this.gainNode = null,
            this.lowPassFilter1 = null,
            this.lowPassFilter2 = null,
            this.highPassFilter1 = null,
            this.highPassFilter2 = null,
            this.lowestFreq = 30,
            this.highestFreq = 4200,
            this.twelfthRootOfTwo = 1.0594630943592953,
            this.otthRootOfTwo = 1.0005777895,
            this.refNoteLabels = ["A","A#","B","C","C#","D","D#","E","F","F#","G","G#"],
            this.refFreq = 440,
            this.refNoteIndex = 0,
            this.noteFrequencies = [],
            this.noteLabels = [],
            this.pitchHistory = [],
            this.pixelsPerCent = 3,
            this.silenceTimeout = null,
            this.minUpdateDelay = 100                }
            return _createClass(TunerInputModel, [{
                key: "run",
                value: function() {
                    //if (!(window.requestAnimationFrame && window.AudioContext && navigator.getUserMedia && false)) 
                    if (!(window.requestAnimationFrame && window.AudioContext && navigator.getUserMedia)) 
                    {
                        //faire notif   
                        $('body').notif({title:lang_jsProblemAudio, cls:'error', timeout:200000});                
                        noguitar = true;
                        $('#scoreResult').hide();
                        $('.playedNote').hide();
                        $('.playedNoteNote').hide();
                        return this.error("WebAudio API is unavalable");
                    }
                    try {
                        navigator.getUserMedia({
                            audio: !0
                        }, function(stream) {
                            this.gotStream(stream)
                        }.bind(this), function(err) {
                            $('body').notif({title:lang_jsProblemAudio, cls:'error', timeout:20000});                
                            noguitar = true;
                            $('#scoreResult').hide();
                            $('.playedNote').hide();
                            $('.playedNoteNote').hide();
                            return this.error("Error getting microphone input: " + err)
                        }.bind(this))
                    } catch (e) {
                        $('body').notif({title:lang_jsProblemAudio, cls:'error', timeout:20000});               
                        noguitar = true;
                        $('#scoreResult').hide();
                        $('.playedNote').hide();
                        $('.playedNoteNote').hide();
                        return this.error("Error getting microphone input: " + e)
                    }
                }
            }, 

            {
                key: "initGui",
                value: function() {
                    this.defineNoteFrequencies(); 
/*
                    frequencyArray = new Uint8Array(this.analyserNode.frequencyBinCount);


                    visualizer.setAttribute('viewBox', '0 0 255 255');

                    for (var i = 0 ; i < 255; i++) {
                        path = document.createElementNS('http://www.w3.org/2000/svg', 'path');
                        path.setAttribute('stroke-dasharray', '4,1');
                        mask.appendChild(path);
                    }
                    */
                    this.updatePitch();
                }
            },
            

            {
                key: "gotStream",
                value: function(stream) 
                {
                    window.persistAudioStream = stream;
                    this.audioContext = new AudioContext;
                    this.microphoneNode = this.audioContext.createMediaStreamSource(stream);
                    this.analyserNode = this.audioContext.createAnalyser();
                    this.analyserNode.fftSize = 2048;
                    this.analyserNode.smoothingTimeConstant = .8;
                    this.gainNode = this.audioContext.createGain();
                    this.gainNode.gain.value = 1.5;
                    this.lowPassFilter1 = this.audioContext.createBiquadFilter();
                    this.lowPassFilter2 = this.audioContext.createBiquadFilter();
                    this.highPassFilter1 = this.audioContext.createBiquadFilter();
                    this.highPassFilter2 = this.audioContext.createBiquadFilter();
                    this.lowPassFilter1.Q.value = 0;
                    this.lowPassFilter1.frequency.value = this.highestFreq;
                    this.lowPassFilter1.type = "lowpass";
                    this.lowPassFilter2.Q.value = 0;
                    this.lowPassFilter2.frequency.value = this.highestFreq;
                    this.lowPassFilter2.type = "lowpass";
                    this.highPassFilter1.Q.value = 0;
                    this.highPassFilter1.frequency.value = this.lowestFreq;
                    this.highPassFilter1.type = "highpass";
                    this.highPassFilter2.Q.value = 0;
                    this.highPassFilter2.frequency.value = this.lowestFreq;
                    this.highPassFilter2.type = "highpass";
                    this.microphoneNode.connect(this.lowPassFilter1);
                    this.lowPassFilter1.connect(this.lowPassFilter2);
                    this.lowPassFilter2.connect(this.highPassFilter1);
                    this.highPassFilter1.connect(this.highPassFilter2);
                    this.highPassFilter2.connect(this.gainNode);
                    this.gainNode.connect(this.analyserNode);
                    this.initGui();                
                }

            }, {
                key: "updatePitch",
                value: function() {
                    var pitchInHz = 0,
                    volumeCheck = !1,
                    maxVolume = 128,
                    inputBuffer = new Uint8Array(this.analyserNode.fftSize);
                    this.analyserNode.getByteTimeDomainData(inputBuffer);
                    for (var i = 0; i < inputBuffer.length / 4; i++) 
                    {
                        maxVolume < inputBuffer[i] && (maxVolume = inputBuffer[i]), 
                        !volumeCheck && inputBuffer[i] > this.volumeThreshold && (volumeCheck = !0);
                    }
                    //console.log(inputBuffer[2]+"yyy");
                    volumeCheck && (pitchInHz = this.Yin.getPitch(inputBuffer, this.audioContext.sampleRate));
                    
/*

                    if (DEBUGCANVAS) {  
                        waveCanvas.clearRect(0,0,512,256);

                        waveCanvas.strokeStyle = "lightgray";
                        waveCanvas.beginPath();
                        waveCanvas.moveTo(0,inputBuffer[0]);

                        for (var i=1;i<512;i++) {
                            waveCanvas.lineTo(i,16+(inputBuffer[i]*16));
                        }
                        waveCanvas.stroke();
                    }*/

/*
                   //this.analyserNode.fftSize = 256;
                   var bufferLength = this.analyserNode.frequencyBinCount;
                   //var bufferLength = inputBuffer;
                   //1console.log(bufferLength);
                   //var dataArray = new Uint8Array(bufferLength);

                   waveCanvas.clearRect(0,0,512,256);
                   //canvasCtx.clearRect(0, 0, 512, 256);

                   //this.analyserNode.getByteFrequencyData(dataArray);

                   //waveCanvas.fillStyle = 'rgb(255, 255, 0)';
                   //waveCanvas.fillRect(0, 0, 512, 256);
                   var barWidth = 1;
                   var barHeight;
                   var x = 0;
                   for(var i = 0; i < inputBuffer.length; i=i+1) {
                    barHeight = (inputBuffer[i]/2);
                    //barHeight = 2;

                    waveCanvas.fillStyle = '#ddd';
                    //waveCanvas.fillRect(x,180-barHeight/2,barWidth,barHeight);
                    waveCanvas.fillRect(x,256-barHeight/2,barWidth,barHeight);
                   x += barWidth + 1;
               }
               */


               // window.persistAudioStream = stream;
/*
               var audioContent = new AudioContext();
               var audioStream = audioContent.createMediaStreamSource( stream );
               var analyser = audioContent.createAnalyser();
               audioStream.connect(analyser);
               analyser.fftSize = 1024;
               */
               // var frequencyArray = new Uint8Array(analyser.frequencyBinCount);
/*
               var frequencyArray = new Uint8Array(this.analyserNode.frequencyBinCount);


               visualizer.setAttribute('viewBox', '0 0 255 255');

               for (var i = 0 ; i < 255; i++) {
                path = document.createElementNS('http://www.w3.org/2000/svg', 'path');
                path.setAttribute('stroke-dasharray', '4,1');
                mask.appendChild(path);
            }*/


           // this.doDraw();

           // requestAnimationFrame( this.doDraw);

           /*
           this.analyserNode.getByteFrequencyData(frequencyArray);
           
           for (var i = 0 ; i < 255; i++) {
            adjustedLength = Math.floor(frequencyArray[i]) - (Math.floor(frequencyArray[i]) % 5);
            pathsViz[i].setAttribute('d', 'M '+ (i) +',255 l 0,-' + adjustedLength);
        }

        */


















        var allowedHzDifference = 5;

        if (0 != pitchInHz) {
            clearTimeout(this.silenceTimeout),
            this.silenceTimeout = null,
            this.pitchHistory.length >= this.nPitchValues && this.pitchHistory.shift(),
            this.pitchHistory.length && Math.abs(pitchInHz / 2 - this.pitchHistory[this.pitchHistory.length - 1]) < allowedHzDifference && (pitchInHz /= 2),
            pitchInHz = Math.round(10 * pitchInHz) / 10,
            this.pitchHistory.push(pitchInHz);

            var sortedPitchHistory = this.pitchHistory.slice(0).sort(function(a, b) {
                return a - b
            });
                    ////1console.log("inputBuffer : "+inputBuffer);
                    pitchInHz = sortedPitchHistory[Math.floor((sortedPitchHistory.length - 1) / 2)], 
                    //1console.log("pitch : "+pitchInHz);
                    this.updateGui(pitchInHz, this.getClosestNoteIndex(pitchInHz), (maxVolume - 128) / 128); 
                    if(this.pitchHistory.length < this.nPitchValues)
                    {

                        if(active == true) glRaf = window.requestAnimationFrame(function() {this.updatePitch()}.bind(this))
                    }
                else
                {
                    if(active == true) {
                     setTimeout(function() {
                        glRaf = window.requestAnimationFrame(function() {this.updatePitch()}.bind(this))
                    }.bind(this), this.minUpdateDelay)
                 }

             }


         } else null === this.silenceTimeout && (this.silenceTimeout = setTimeout(function() {
            this.pitchHistory = [], this.updateGui(0, !1, 0)
        }.bind(this), 500)), window.requestAnimationFrame(function() {
            this.updatePitch()
        }.bind(this))
    }
}, {
    key: "defineNoteFrequencies",
    value: function() {
        //1console.log("defineNoteFrequencies");
        for (var noteFreq = 0, 
            greaterNoteFrequencies = [], 
            greaterNoteLabels = [], 
            lowerNoteFrequencies = [], 
            lowerNoteLabels = [], 
            octave = 4, i = 0;

            (i + 9) % 12 == 0 && octave++, 
            noteFreq = this.refFreq * Math.pow(this.twelfthRootOfTwo, i), 
            !(noteFreq > 4187); i++) greaterNoteFrequencies.push(noteFreq), greaterNoteLabels.push(octave + this.refNoteLabels[(this.refNoteIndex + i) % this.refNoteLabels.length]);
            octave = 4;

        for (
            var i = -1;

            (Math.abs(i) + 2) % 12 == 0 && octave--, 
            noteFreq = this.refFreq * Math.pow(this.twelfthRootOfTwo, i), 
            !(noteFreq < 28); i--
            ) 
        {
            lowerNoteFrequencies.push(noteFreq);
            var relativeIndex = (this.refNoteIndex + i) % this.refNoteLabels.length;

            relativeIndex = 0 == relativeIndex ? 0 : relativeIndex + this.refNoteLabels.length, lowerNoteLabels.push(octave + this.refNoteLabels[relativeIndex])
        }

        lowerNoteFrequencies.reverse(), lowerNoteLabels.reverse(), this.noteFrequencies = lowerNoteFrequencies.concat(greaterNoteFrequencies), this.noteLabels = lowerNoteLabels.concat(greaterNoteLabels);
        var filtered = this.tuning.filterByTuning(this.tuning_name, this.noteLabels, this.noteFrequencies);
        this.noteFrequencies = filtered.freqs;
        this.noteFrequencies = [17.324, 18.354, 19.445, 20.601, 21.827, 23.124, 24.499, 25.956, 27.5, 29.135, 30.868, 32.703, 34.648, 36.708, 38.891, 41.203, 43.654, 46.249, 48.999, 51.913, 55, 58.27, 61.735, 65.406, 69.296, 73.416, 77.782, 82.407, 87.307, 92.499, 97.999, 103.826, 110, 116.541, 123.471, 130.813, 138.591, 146.832, 155.563, 164.814, 174.614, 184.997, 195.998, 207.652, 220, 233.082, 246.942, 261.626, 277.183, 293.665, 311.127, 329.628, 349.228, 369.994, 391.995, 415.305, 440, 466.164, 493.883, 523.251, 554.365, 587.33, 622.254, 659.255, 698.456, 739.989, 783.991, 830.609, 880, 932.328, 987.767, 1046.502, 1108.731, 1174.659, 1244.508, 1318.51, 1396.913, 1479.978, 1567.982, 1661.219, 1760, 1864.655, 1975.533, 2093.005, 2217.461, 2349.318, 2489.016, 2637.021, 2793.826, 2959.955, 3135.964, 3322.438, 3520, 3729.31, 3951.066, 4186.009, 4434.922, 4698.636, 4978.032, 5274.042, 5587.652, 5919.91, 6271.928, 6644.876, 7040, 7458.62, 7902.132, 8372.018, 8869.844, 9397.272, 9956.064, 10548.084, 11175.304, 11839.82, 12543.856, 13289.752, 14080, 14917.24, 15804.264];
        this.noteLabels = filtered.notes;
        this.noteLabels = ["CD0", "DN0", "DD0", "EN0", "FN0", "FD0", "GN0", "GD0", "AN0", "AD0", "BN0", "CN1", "CD1", "DN1", "DD1", "EN1", "FN1", "FD1", "GN1", "GD1", "AN1", "AD1", "BN1", "CN2", "CD2", "DN2", "DD2", "EN2", "FN2", "FD2", "GN2", "GD2", "AN2", "AD2", "BN2", "CN3", "CD3", "DN3", "DD3", "EN3", "FN3", "FD3", "GN3", "GD3", "AN3", "AD3", "BN3", "CN4", "CD4", "DN4", "DD4", "EN4", "FN4", "FD4", "GN4", "GD4", "AN4", "AD4", "BN4", "CN5", "CD5", "DN5", "DD5", "EN5", "FN5", "FD5", "GN5", "GD5", "AN5", "AD5", "BN5", "CN6", "CD6", "DN6", "DD6", "EN6", "FN6", "FD6", "GN6", "GD6", "AN6", "AD6", "BN6", "CN7", "CD7", "DN7", "DD7", "EN7", "FN7", "FD7", "GN7", "GD7", "AN7", "AD7", "BN7", "CN8", "CD8", "DN8", "DD8", "EN8", "FN8", "FD8", "GN8", "GD8", "AN8", "AD8", "BN8", "CN9", "CD9", "DN9", "DD9", "EN9", "FN9", "FD9", "GN9", "GD9", "AN9", "AD9", "BN9"];
    }
}, {
    key: "getCentDiff",
    value: function(fCurrent, fRef) {
        return 1200 * Math.log(fCurrent / fRef) / Math.log(2)
    }
}, {
    key: "getClosestNoteIndex",
    value: function(f) {
        if (0 == f) return !1;

        for (var i = 0; i < this.noteFrequencies.length; i++)
            if (f < this.noteFrequencies[i]) return i > 0 && this.noteFrequencies[i] - f > f - this.noteFrequencies[i - 1] ? i - 1 : i;

        var testtt=this.noteFrequencies.length - 1;

        return this.noteFrequencies.length - 1
    }
}, {
    key: "findRefNoteIndex",
    value: function(noteLabel) {
        for (var i = 0; i < this.refNoteLabels.length; i++)
            if (this.refNoteLabels[i] == noteLabel) return i;
        return !1
    }
}, {
    key: "getNote",
    value: function(index) {
        var note = this.noteLabels[index];
        evaluateGuitarListener(note);
        //1console.log("index : "+index);
        //1console.log("getNote : "+note);
        //1console.log("freqNote : "+this.noteFrequencies[index]);

        return {
            note: note,
            octave: note.charAt(0),
            alter: note.length > 2,
            string: index
        }
    }
}, {
    key: "updateGui",
    value: function(currentFreq, closestIndex, maxVolume) {

        if (closestIndex === !1 || 0 == currentFreq) this.view.renderSilence(!0);
        else {
            var centDiff = this.getCentDiff(currentFreq, this.noteFrequencies[closestIndex]).toFixed(1);
            this.view.renderSilence(!1), 
            this.view.renderCent(centDiff), 
            this.view.renderNote(this.getNote(closestIndex)), 
            this.view.renderFreq(currentFreq), 
            Math.abs(centDiff) < 5 ? this.view.renderState(0) : this.view.renderState(centDiff)
        }
    }
}, {
    key: "error",
    value: function(message) {}
}]), TunerInputModel
}();
exports["default"] = TunerInputModel, module.exports = exports["default"]
}, {
    "./TuningModel": 2,
    "./YinPitchEstimationModel": 3
}],
2: [function(require, module, exports) {
    "use strict";

    function _classCallCheck(instance, Constructor) {
        if (!(instance instanceof Constructor)) throw new TypeError("Cannot call a class as a function")
    }
Object.defineProperty(exports, "__esModule", {
    value: !0
});
var _createClass = function() {
    function defineProperties(target, props) {
        for (var i = 0; i < props.length; i++) {
            var descriptor = props[i];
            descriptor.enumerable = descriptor.enumerable || !1, descriptor.configurable = !0, "value" in descriptor && (descriptor.writable = !0), Object.defineProperty(target, descriptor.key, descriptor)
        }
    }
    return function(Constructor, protoProps, staticProps) {
        return protoProps && defineProperties(Constructor.prototype, protoProps), staticProps && defineProperties(Constructor, staticProps), Constructor
    }
}(),
TuningModel = function() {
    function TuningModel() {
        _classCallCheck(this, TuningModel), this.tunings = {
            Standard: ["2E", "2A", "3D", "3G", "3B", "4E"]
        }
    }
    return _createClass(TuningModel, [{
        key: "filterByTuning",
        value: function(tuning_name, notes, freqs) {
            for (var indexes = [], tuning_notes = this.tunings[tuning_name], result = {
                notes: [],
                freqs: []
            }, i = 0; i < tuning_notes.length; i++)
                for (var j = 0; j < notes.length; j++)
                    if (tuning_notes[i] == notes[j]) {
                        indexes.push(j);
                        break
                    }
                    for (var i = 0; i < indexes.length; i++) result.notes.push(notes[indexes[i]]), result.freqs.push(freqs[indexes[i]]);
                        return result
                }
            }]), TuningModel
}();
exports["default"] = TuningModel, module.exports = exports["default"]
}, {}],
3: [function(require, module, exports) {
    "use strict";

    function _classCallCheck(instance, Constructor) {
        if (!(instance instanceof Constructor)) throw new TypeError("Cannot call a class as a function")
    }
Object.defineProperty(exports, "__esModule", {
    value: !0
});
var _createClass = function() {
    function defineProperties(target, props) {
        for (var i = 0; i < props.length; i++) {
            var descriptor = props[i];
            descriptor.enumerable = descriptor.enumerable || !1, descriptor.configurable = !0, "value" in descriptor && (descriptor.writable = !0), Object.defineProperty(target, descriptor.key, descriptor)
        }
    }
    return function(Constructor, protoProps, staticProps) {
        return protoProps && defineProperties(Constructor.prototype, protoProps), staticProps && defineProperties(Constructor, staticProps), Constructor
    }
}(),
YinPitchEstimationModel = function() {
    function YinPitchEstimationModel() {
        _classCallCheck(this, YinPitchEstimationModel), this.yinThreshold = .15, this.yinProbability = 0
    }
    return _createClass(YinPitchEstimationModel, [{
        key: "getPitch",
        value: function(inputBuffer, sampleRate) {
            var yinBuffer = new Float32Array(Math.floor(inputBuffer.length / 2));
            yinBuffer[0] = 1;
            for (var minTauValue, runningSum = 0, pitchInHz = 0, foundTau = !1, minTau = 0, tau = 1; tau < Math.floor(inputBuffer.length / 2); tau++) {
                yinBuffer[tau] = 0;
                for (var i = 0; i < Math.floor(inputBuffer.length / 2); i++) yinBuffer[tau] += Math.pow((inputBuffer[i] - 128) / 128 - (inputBuffer[i + tau] - 128) / 128, 2);
                    if (runningSum += yinBuffer[tau], yinBuffer[tau] = yinBuffer[tau] * (tau / runningSum), tau > 1)
                        if (foundTau) {
                            if (!(yinBuffer[tau] < minTauValue)) break;
                            minTauValue = yinBuffer[tau], minTau = tau
                        } else yinBuffer[tau] < this.yinThreshold && (foundTau = !0, minTau = tau, minTauValue = yinBuffer[tau])
                    }
                    return 0 == minTau ? (this.yinProbability = 0, pitchInHz = 0) : (minTau += (yinBuffer[minTau + 1] - yinBuffer[minTau - 1]) / (2 * (2 * yinBuffer[minTau] - yinBuffer[minTau - 1] - yinBuffer[minTau + 1])), pitchInHz = sampleRate / minTau, this.yinProbability = 1 - minTauValue), pitchInHz
                }
            }]), YinPitchEstimationModel
}();
exports["default"] = YinPitchEstimationModel, module.exports = exports["default"]
}, {}],
4: [function(require, module, exports) {
    "use strict";

    function _interopRequireDefault(obj) {
        return obj && obj.__esModule ? obj : {
            "default": obj
        }
    }
    var _modelTunerInputModel = require("./model/TunerInputModel"),
    _modelTunerInputModel2 = _interopRequireDefault(_modelTunerInputModel),
    _viewsTunerInputView = require("./views/TunerInputView"),
    _viewsTunerInputView2 = _interopRequireDefault(_viewsTunerInputView);
    window.requestAnimationFrame = window.requestAnimationFrame || 
    window.mozRequestAnimationFrame || 
    window.webkitRequestAnimationFrame || 
    window.msRequestAnimationFrame, window.AudioContext = window.AudioContext || 
    window.webkitAudioContext || 
    window.mozAudioContext || 
    window.oAudioContext || 
    window.msAudioContext, navigator.getUserMedia = navigator.getUserMedia || 
    navigator.webkitGetUserMedia || navigator.mozGetUserMedia || 
    navigator.msGetUserMedia;
    var tuner = new _modelTunerInputModel2["default"](new _viewsTunerInputView2["default"]);
    tuner.run()
}, {
    "./model/TunerInputModel": 1,
    "./views/TunerInputView": 5
}],
5: [function(require, module, exports) {
    "use strict";

    function _classCallCheck(instance, Constructor) {
        if (!(instance instanceof Constructor)) throw new TypeError("Cannot call a class as a function")
    }
Object.defineProperty(exports, "__esModule", {
    value: !0
});

var _createClass = function() {
    function defineProperties(target, props) {
        for (var i = 0; i < props.length; i++) {
            var descriptor = props[i];
            descriptor.enumerable = descriptor.enumerable || !1, descriptor.configurable = !0, "value" in descriptor && (descriptor.writable = !0), Object.defineProperty(target, descriptor.key, descriptor)
        }
    }
    return function(Constructor, protoProps, staticProps) {
        return protoProps && defineProperties(Constructor.prototype, protoProps), staticProps && defineProperties(Constructor, staticProps), Constructor
    }
}(),
TunerInputView = function() {
    function TunerInputView() {
        _classCallCheck(this, TunerInputView), this.$wrapper = document.querySelector(this.dom().wrapper), 
        this.$note = document.querySelector(this.dom().note), 
        this.$freq = document.querySelector(this.dom().freq), 
        this.$scale_left = document.querySelector(this.dom().scale_left), 
        this.$scale_right = document.querySelector(this.dom().scale_right), 
        this.$note = document.querySelector(this.dom().note),         
        this.$string_notes = document.querySelectorAll(this.dom().string_notes), 
        this.silence_timer = null, this.silence_timeout = 2e3
    }
    return _createClass(TunerInputView, [{
        key: "dom",
        value: function() {
            return {
                wrapper: ".js-tuner_wrapper",
                string_note_prefix: ".js-ugtune_string_note_",
                string_notes: ".js-ugtune_string_note",                
                scale_left: ".js-ugtune_scale_left",
                scale_right: ".js-ugtune_scale_right",
                note: ".js-note",
                freq: ".js-freq"
            }
        }
    }, {
        key: "classes",
        value: function() {
            return {
                wrapper_silence: "ugtune--silence",
                wrapper_success: "ugtune--success",
                wrapper_fail: "ugtune--fail",
                note_active: "ugtune-stave--note__active",
                note_fail: "ugtune-scale--note__false",
                note_success: "ugtune-scale--note__success"
            }
        }
    }, {
        key: "renderSilence",
        value: function(state) {
            if(state){
                this.silence_timer = setTimeout(function() {
                //this.$wrapper.classList.add(this.classes().wrapper_silence), 
                //this.$note.classList.remove(this.classes().note_fail), 
                //this.$note.classList.remove(this.classes().note_success), 
                //this.$note.innerHTML = "", 
                //this.deActivateStrings(),
                displaySilence()
            }.bind(this), this.silence_timeout)}
            }
        }, {
            key: "renderState",
            value: function(state) {

            /*
            if (this.silence_timer = null, 0 == state) 
                this.$wrapper.classList.remove(this.classes().wrapper_silence), 
            this.$wrapper.classList.remove(this.classes().wrapper_fail), 
            this.$wrapper.classList.add(this.classes().wrapper_success), 
            this.$scale_left.style.width = "0", 
            this.$scale_right.style.width = "0",    
            this.$note.classList.remove(this.classes().note_fail), 
            this.$note.classList.add(this.classes().note_success);
            else {
                var width = Math.abs(state) > 50 ? 50 : Math.abs(state);
                this.$wrapper.classList.remove(this.classes().wrapper_silence),
                this.$wrapper.classList.remove(this.classes().wrapper_success),
                this.$wrapper.classList.add(this.classes().wrapper_fail),
                this.$note.classList.add(this.classes().note_fail),
                this.$note.classList.remove(this.classes().note_success),
                state < 0 ? (                    
                    this.$scale_right.style.width = "0",
                    this.$scale_left.style.width = width + "%") : (                   
                    this.$scale_left.style.width = "0",
                    this.$scale_right.style.width = width + "%")
                }
                */
                return false;
            }
        }, {
            key: "deActivateStrings",
            value: function() {
                this.$scale_left.style.width = "0", this.$scale_right.style.width = "0";
                for (var i = 0; i < this.$string_notes.length; i++) this.$string_notes[i].classList.remove(this.classes().note_active)
            }
    }, {
        key: "renderFreq",
        value: function(freq) {
            //this.$freq.innerHTML = freq;

        }
    }, {
        key: "renderCent",
        value: function(diff) {}
    }, {
        key: "renderNote",
        value: function(note) {
            //this.$note.innerHTML = note.note, 
            //this.deActivateStrings(), 

            //1console.log("show : "+note.note);
            //1console.log("------------------------");
        }
    }]), TunerInputView
}();
exports["default"] = TunerInputView, module.exports = exports["default"]
}, {}]
}, {}, [4]);

}