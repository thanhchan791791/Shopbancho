<!DOCTYPE html>
<html lang="en">
<head>
<style type = "text/css" media = "all">
            @import url(https://fonts.googleapis.com/css?family=Varela+Round);

html, body { background: #333 url("https://codepen.io/images/classy_fabric.png"); }

ul, li { display: block; }

#body {
    left: 50%;
    width: 609px;
    height: 405px;
    display: block;
    position: absolute;
    margin-left: -305px;
}

#body * {
    user-select: none;
    -ms-user-select: none;
    -moz-user-select: none;
    -khtml-user-select: none;
    -webkit-user-select: none;
    -webkit-touch-callout: none;
}

#body input { display: none; }

#img-inner {
    top: 0;
    opacity: 0;
    width: 609px;
    height: 405px;
    display: block;
    position: absolute;
    
    transform: scale(0);
    -moz-transform: scale(0);
    -webkit-transform: scale(0);
    
    transition: all .7s ease-in-out;
    -moz-transition: all .7s ease-in-out;
    -webkit-transition: all .7s ease-in-out;
}

#img-inner img {
    width: 100%;
    height: 100%;
}

#img-inner:nth-of-type(1) {
    /* And... CSS3 image preloading :D */
    background-image:
        url("http://farm9.staticflickr.com/8504/8365873811_d32571df3d_z.jpg"),
        url("http://farm9.staticflickr.com/8068/8250438572_d1a5917072_z.jpg"),
        url("http://farm9.staticflickr.com/8061/8237246833_54d8fa37f0_z.jpg"),
        url("http://farm9.staticflickr.com/8055/8098750623_66292a35c0_z.jpg"),
        url("http://farm9.staticflickr.com/8195/8098750703_797e102da2_z.jpg");
}

#img-inner:hover ~ label.sb-bignav { opacity: 0.5; }

label.sb-bignav:hover { opacity: 1; }


.sb-bignav {
    width: 200px;
    height: 100%;
    display: none;
    position: absolute;
    
    opacity: 0;
    z-index: 9;
    cursor: pointer;
    
    transition: opacity .2s;
    -moz-transition: opacity .2s;
    -webkit-transition: opacity .2s;
	
    color: white;
    font-size: 156pt;
    text-align: center;
    line-height: 380px;
    font-family: "Varela Round", sans-serif;
    background-color: rgba(255, 255, 255, .3);
    text-shadow: 0px 0px 15px rgb(119, 119, 119);
}

label[title="Next"] { right: 0; }

input:checked + li > #img-inner {
    opacity: 1;
        
    transform: scale(1);
    -moz-transform: scale(1);
    -webkit-transform: scale(1);
    
    transition: opacity 1s ease-in-out;
    -moz-transition: opacity 1s ease-in-out;
    -webkit-transition: opacity 1s ease-in-out;
}

input:checked + li > label { display: block; }
        </style>
</head><!--/head-->

<body>
    <!-- NOTE: None of the included images are mine and I take no credit for them!! -->
<ul id="body">
    <input type="radio" name="radio-btn" id="img-1" checked />
    <li id="img-container">
        <div id="img-inner">
            <img src="http://farm9.staticflickr.com/8072/8346734966_f9cd7d0941_z.jpg">
        </div>
        <label for="img-6" class="sb-bignav" title="Previous">&#x2039;</label>
        <label for="img-2" class="sb-bignav" title="Next">&#x203a;</label>
    </li>
    
    <input type="radio" name="radio-btn" id="img-2" />
    <li id="img-container">
        <div id="img-inner">
            <img src="http://farm9.staticflickr.com/8504/8365873811_d32571df3d_z.jpg">
        </div>
        <label for="img-1" class="sb-bignav" title="Previous">&#x2039;</label>
        <label for="img-3" class="sb-bignav" title="Next">&#x203a;</label>
    </li>
    
    <input type="radio" name="radio-btn" id="img-3" />
    <li id="img-container">
        <div id="img-inner">
            <img src="http://farm9.staticflickr.com/8068/8250438572_d1a5917072_z.jpg">
        </div>
        <label for="img-2" class="sb-bignav" title="Previous">&#x2039;</label>
        <label for="img-4" class="sb-bignav" title="Next">&#x203a;</label>
    </li>
    
    <input type="radio" name="radio-btn" id="img-4" />
    <li id="img-container">
        <div id="img-inner">
            <img src="http://farm9.staticflickr.com/8061/8237246833_54d8fa37f0_z.jpg">
        </div>
        <label for="img-3" class="sb-bignav" title="Previous">&#x2039;</label>
        <label for="img-5" class="sb-bignav" title="Next">&#x203a;</label>
    </li>
    
    <input type="radio" name="radio-btn" id="img-5" />
    <li id="img-container">
        <div id="img-inner">
            <img src="http://farm9.staticflickr.com/8055/8098750623_66292a35c0_z.jpg">
        </div>
        <label for="img-4" class="sb-bignav" title="Previous">&#x2039;</label>
        <label for="img-6" class="sb-bignav" title="Next">&#x203a;</label>
    </li>
    
    <input type="radio" name="radio-btn" id="img-6" />
    <li id="img-container">
        <div id="img-inner">
            <img src="http://farm9.staticflickr.com/8195/8098750703_797e102da2_z.jpg">
        </div>
        <label for="img-5" class="sb-bignav" title="Previous">&#x2039;</label>
        <label for="img-1" class="sb-bignav" title="Next">&#x203a;</label>
    </li>
</ul>
</body>
</html>