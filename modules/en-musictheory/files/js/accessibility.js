/*
    Copyright (c) 2008 Ricci Adams

    Permission is hereby granted, free of charge, to any person
    obtaining a copy of this software and associated documentation
    files (the "Software"), to deal in the Software without
    restriction, including without limitation the rights to use,
    copy, modify, merge, publish, distribute, sublicense, and/or sell
    copies of the Software, and to permit persons to whom the
    Software is furnished to do so, subject to the following
    conditions:

    The above copyright notice and this permission notice shall be
    included in all copies or substantial portions of the Software.

    THE SOFTWARE IS PROVIDED "AS IS", WITHOUT WARRANTY OF ANY KIND,
    EXPRESS OR IMPLIED, INCLUDING BUT NOT LIMITED TO THE WARRANTIES
    OF MERCHANTABILITY, FITNESS FOR A PARTICULAR PURPOSE AND
    NONINFRINGEMENT. IN NO EVENT SHALL THE AUTHORS OR COPYRIGHT
    HOLDERS BE LIABLE FOR ANY CLAIM, DAMAGES OR OTHER LIABILITY,
    WHETHER IN AN ACTION OF CONTRACT, TORT OR OTHERWISE, ARISING
    FROM, OUT OF OR IN CONNECTION WITH THE SOFTWARE OR THE USE OR
    OTHER DEALINGS IN THE SOFTWARE.
*/


function LessonLoader(xmlFile, callback)
{
    this._construct_s_f(xmlFile, callback);
}


LessonLoader.prototype._construct_s_f = function(xmlFile, callback)
{
    this._xmlFile = xmlFile;
    this._callback = callback;

    var request = null;

    if (typeof XMLHttpRequest != "undefined") {
        request = new XMLHttpRequest();
    } else if (typeof ActiveXObject != "undefined") {
        request = new ActiveXObject("Microsoft.XMLHTTP");
    }
    
    var owner = this;

    request.onreadystatechange = function() {
        if (request.readyState == 4) {
            owner._parseXMLText(request.responseText);
        }
    }
    
    request.open("GET", xmlFile, true);
    request.send(null);
}


LessonLoader.prototype._parseXMLText = function(xmlText)
{
    var xmlDoc = null;

    try {
        xmlDoc = new ActiveXObject("Microsoft.XMLDOM");
        xmlDoc.async = "false";
        xmlDoc.loadXML(xmlText);
    } catch(e) {
        try {
            var parser = new DOMParser();
            xmlDoc = parser.parseFromString(xmlText, "text/xml");
        } catch(e) { }
    }

    if (xmlDoc) {
        this._parseXMLDoc(xmlDoc);
    }
    
    this._callback.call(this, this._lesson);
}


LessonLoader.prototype._parseXMLDoc = function(xmlDoc)
{
    for (var node = xmlDoc.firstChild; node != null; node = node.nextSibling) {
        if (node.nodeName == "lesson") {
            this._parseLesson(node);
        }
    }
}


LessonLoader.prototype._parseCopyright = function(node)
{
    this._lesson.copyright = node.firstChild.nodeValue;
}


LessonLoader.prototype._parseGotoAndPlay = function(node)
{
    this._workingSlide.shouldPlay = true;
    this._workingSlide.frameLabel = node.attributes.getNamedItem("label").nodeValue;
}


LessonLoader.prototype._parseGotoAndStop = function(node)
{
    this._workingSlide.shouldPlay = false;
    this._workingSlide.frameLabel = node.attributes.getNamedItem("label").nodeValue;
}


LessonLoader.prototype._parseLesson = function(node)
{
    this._lesson = { };
    this._lesson.slides = [ ];
    this._lesson.variables = { };

    this._workingSlide = { };

    for (var child = node.firstChild; child != null; child = child.nextSibling) {
        var func = {
            "copyright":   this._parseCopyright,
            "section":     this._parseSection,
            "title":       this._parseTitle,
            "translation": this._parseTranslation,
            "var":         this._parseVar
        }[child.nodeName];

        if (func) func.call(this, child);
    }
}


LessonLoader.prototype._parseSection = function(node)
{
    this._workingSlide.sectionText = [ ];

    for (var child = node.firstChild; child != null; child = child.nextSibling) {
        var func = {
            gotoAndPlay: this._parseGotoAndPlay,
            gotoAndStop: this._parseGotoAndStop,
            text:        this._parseText
        }[child.nodeName];

        if (func) func.call(this, child);
    }
}


LessonLoader.prototype._parseText = function(node)
{
    function _parse_text_r(node) {
        var text = "";

        for (var child = node.firstChild; child != null; child = child.nextSibling) {
            if (child.nodeName == "b") {
                text += "<b>" + _parse_text_r(child) + "</b>";
            } else if (child.nodeName == "i") {
                text += "<i>" + _parse_text_r(child) + "</i>";
            } else if (child.nodeName == "br") {
                text += "\n";
            } else {
                text += child.nodeValue;
            }
        }
        
        return text;
    }

    var text = _parse_text_r(node);
    
    this._workingSlide.sectionText.push(text);
    this._workingSlide.text = text;
    
    var slideToPush = { };
    for (var property in this._workingSlide) {
        slideToPush[property] = this._workingSlide[property];
    }
        
    this._lesson.slides.push(slideToPush);
}


LessonLoader.prototype._parseTitle = function(node)
{
    this._workingSlide.title = node.firstChild.nodeValue;
}


LessonLoader.prototype._parseTranslation = function(node)
{
    this._lesson.translation = node.firstChild.nodeValue;
}


LessonLoader.prototype._parseVar = function(node)
{
    var key   = node.attributes.getNamedItem("name").nodeValue;
    var value = node.firstChild.nodeValue;
    this._lesson.variables[key] = value;
}


function callMovieFunction(func, ax, bx) 
{    
    var movie = document.getElementById("movieAsObject");
    
    try {
        movie.SetVariable("_js_test", 1);
    } catch (e) {
        movie = document.getElementById("movieAsEmbed");
        try { movie.SetVariable("_js_test", 1); } catch (e) { movie = null; }
    }

    if (movie) {
        if (ax) movie.SetVariable("_js_ax",   ax);
        if (bx) movie.SetVariable("_js_bx",   bx);
                movie.SetVariable("_js_func", func);
    }
}


function gotoAndPlay(name)     { callMovieFunction("gotoAndPlay", name, null);  }
function gotoAndStop(name)     { callMovieFunction("gotoAndStop", name, null);  }
function setLabel(name, value) { callMovieFunction("setLabel",    name, value); }


function handleLoadComplete()
{
    top.gMovieLoaded = true;
    setMovieLabelsIfReady();
}


function setMovieLabelsIfReady()
{
    if (top.gLesson != null && top.gMovieLoaded == true) {
        for (var key in top.gLesson.variables) {
            setLabel(key, top.gLesson.variables[key]);
        }
    }
}


function createTitleDiv(title)
{
    var div = document.createElement("div");
    div.className = "title";
    div.innerHTML = title;
    
    return div;
}


function createSlideDiv(slideText, linkHref, linkTitle)
{
    var div = document.createElement("div");
    div.className = "slide";
    
    if (linkHref) {
        var a = document.createElement("a");
        a.href = linkHref;
        a.alt = a.title = linkTitle;

        var img = document.createElement("img");
        img.src = "../../images/transpix.gif";
        img.width = img.height = "16";
        
        a.appendChild(img);

        div.appendChild(a);
    }
    
    var span = document.createElement("span");
    span.innerHTML = slideText;            

    div.appendChild(span);

    return div;
}


function processLesson(lesson)
{
    var titleSlideCounter = 1;
    var lastTitle = null;
    var lastFrameLabel = null;

    var e = document.getElementById("text");
    
    for (var i = 0; i < lesson.slides.length; i++) {
        var slide = lesson.slides[i];

        var linkHref = null;
        var linkTitle = null;
        
        if (lastTitle != slide.title) {
            e.appendChild(createTitleDiv(slide.title));
            lastTitle = slide.title;
        }
        
        if (lastFrameLabel != slide.frameLabel) {
            linkHref  = "javascript:gotoAnd" + (slide.shouldPlay ? "Play" : "Stop") + "('" + slide.frameLabel + "')";
            linkTitle = "View slide " + titleSlideCounter++;
            lastFrameLabel = slide.frameLabel;
        }
        
        e.appendChild(createSlideDiv(slide.text, linkHref, linkTitle));
    }
    
    top.gLesson = lesson;
    setMovieLabelsIfReady();
}


function handleLoad()
{
    loadLesson();
}


if (window.addEventListener) {
    window.addEventListener("load", handleLoad, false);
} else if (window.attachEvent) {
    window.attachEvent("onload", handleLoad);
} else if (document.getElementById) {
    window.onload = handleLoad;
}
