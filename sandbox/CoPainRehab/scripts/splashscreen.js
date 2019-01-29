function photoGallery()
{

	var cellUp=0
	var cellDown=0
	var cellLeft=0
	var cellRight=0
	
	/////////////////////////////////////////////
	//  Set Upper images
	////////
	var uppertitle_row = Math.floor(Math.random()*2)+1  // row will be 1 - 2
	var uppertitle_col = Math.floor(Math.random()*7)+1  // col will be 1 - 7
	var uppertitle_type = 0
	var uppertitle_silo = ""
	var uppertitle_photo = ""
	// memorize other items
		uppermycell = "r"+uppertitle_row+"c"+uppertitle_col;
		cellUp = returnCellType((uppertitle_row-1),uppertitle_col)
		cellDown = returnCellType((uppertitle_row+1),uppertitle_col)
		cellLeft = returnCellType(uppertitle_row,(uppertitle_col-1))
		cellRight = returnCellType(uppertitle_row,(uppertitle_col)+1)	
		// Find a type that's acceptable
		do {
			uppertitle_type = chooseType()
		} while(uppertitle_type==0 || uppertitle_type==cellUp || uppertitle_type==cellDown || uppertitle_type==cellLeft || uppertitle_type==cellRight)
		// alert("cell:"+uppermycell+" - "+uppertitle_type)

		// Find a type that's acceptable
	do {
		uppertitle_type = chooseType()
	} while(uppertitle_type==0 || uppertitle_type==cellUp || uppertitle_type==cellDown || uppertitle_type==cellLeft || uppertitle_type==cellRight)

	// Find an image that is not used in the vicinity
	do {
		uppertitle_silo = chooseSilo()
//	} while(isInRow(uppertitle_row,"s"+uppertitle_silo+".jpg") || isInRow(uppertitle_row-1,"s"+uppertitle_silo+".jpg") || isInRow(uppertitle_row+1,"s"+uppertitle_silo+".jpg"))
	} while(isUsed(uppertitle_row,"s"+uppertitle_silo+".jpg") || isUsed(uppertitle_row-1,"s"+uppertitle_silo+".jpg") || isUsed(uppertitle_row+1,"s"+uppertitle_silo+".jpg"))

	do {
		uppertitle_photo = choosePhoto()
//	} while(isInRow(uppertitle_row,"p"+uppertitle_photo+".jpg") || isInRow(uppertitle_row-1,"p"+uppertitle_photo+".jpg") || isInRow(uppertitle_row+1,"p"+uppertitle_photo+".jpg"))
	} while(isUsed(uppertitle_row,"p"+uppertitle_photo+".jpg") || isUsed(uppertitle_row-1,"p"+uppertitle_photo+".jpg") || isUsed(uppertitle_row+1,"p"+uppertitle_photo+".jpg"))	

	document.getElementById(uppermycell).style.backgroundImage = "none";
	FadeIn(uppermycell)
	setImage(uppertitle_type,uppermycell,uppertitle_silo,uppertitle_photo,uppertitle_row,uppertitle_col);

	/////////////////////////////////////////////
	//  Set Lower images
	////////
	var lowertitle_row = Math.floor(Math.random()*3)+3  // row will be 3 - 5
	var lowertitle_col = Math.floor(Math.random()*7)+1  // col will be 1 - 7
	var lowertitle_type = 0
	var lowertitle_silo = ""
	var lowertitle_photo = ""
	// memorize other items
		lowermycell = "r"+lowertitle_row+"c"+lowertitle_col;
		cellUp = returnCellType((lowertitle_row-1),lowertitle_col)
		cellDown = returnCellType((lowertitle_row+1),lowertitle_col)
		cellLeft = returnCellType(lowertitle_row,(lowertitle_col-1))
		cellRight = returnCellType(lowertitle_row,(lowertitle_col)+1)	
		// Find a type that's acceptable
		do {
			lowertitle_type = chooseType()
		} while(lowertitle_type==0 || lowertitle_type==cellUp || lowertitle_type==cellDown || lowertitle_type==cellLeft || lowertitle_type==cellRight)
//			alert("cell:"+lowermycell+" - "+lowertitle_type)

	// Find an image that is not used in the vicinity
	do {
		lowertitle_silo = chooseSilo()
//	} while(isInRow(lowertitle_row,"s"+lowertitle_silo+".jpg") || isInRow(lowertitle_row-1,"s"+lowertitle_silo+".jpg") || isInRow(lowertitle_row+1,"s"+lowertitle_silo+".jpg"))
	} while(isUsed(lowertitle_row,"s"+lowertitle_silo+".jpg") || isUsed(lowertitle_row-1,"s"+lowertitle_silo+".jpg") || isUsed(lowertitle_row+1,"s"+lowertitle_silo+".jpg"))
//	alert(isInRow(lowertitle_row,lowertitle_silo) + " "+ isInRow(lowertitle_row-1,lowertitle_silo) +" "+ isInRow(lowertitle_row+1,lowertitle_silo))

	do {
		lowertitle_photo = choosePhoto()
//	} while(isInRow(lowertitle_row,"p"+lowertitle_photo+".jpg") || isInRow(lowertitle_row-1,"p"+lowertitle_photo+".jpg") || isInRow(lowertitle_row+1,"p"+lowertitle_photo+".jpg"))
	} while(isUsed(lowertitle_row,"p"+lowertitle_photo+".jpg") || isUsed(lowertitle_row-1,"p"+lowertitle_photo+".jpg") || isUsed(lowertitle_row+1,"p"+lowertitle_photo+".jpg"))
		
	
	// find cell type
//	alert("current cell: "+uppertitle_row+ ", " + uppertitle_col )
//	alert("adjacent cells: up:"+(uppertitle_row-1)+","+uppertitle_col+" down:"+(uppertitle_row+1)+","+uppertitle_col+" left:"+uppertitle_row+","+(uppertitle_col-1)+" right:"+uppertitle_row+","+(uppertitle_col+1)+" ")
//	alert("adjacent cell Types: up:"+returnCellType((uppertitle_row-1),uppertitle_col)+" down:"+returnCellType((uppertitle_row+1),uppertitle_col)+" left:"+returnCellType(uppertitle_row,(uppertitle_col-1))+" right:"+returnCellType(uppertitle_row,(uppertitle_col)+1)+" ")
//alert(uppertitle_type)

	
	document.getElementById(lowermycell).style.backgroundImage = "none";
	FadeIn(lowermycell)
	setImage(lowertitle_type,lowermycell,lowertitle_silo,lowertitle_photo,lowertitle_row,lowertitle_col);
	
	s=setTimeout("photoGallery()",2000)

}

function chooseType(){
	return Math.floor(Math.random()*5)+1  // pic will be 1 - 5
}
function chooseSilo(){
	return 	Math.floor(Math.random()*14)+1  // silo will be 1 - 14
}
function choosePhoto(){
	return Math.floor(Math.random()*16)+1  // photo will be 1 - 16
}

function isInRow(myrow, myimage) {
	var icount = 0;
	for(icount=0; icount<8; icount++) {
		if(ScreenMemory[myrow][icount] == myimage) {
			return true;
		}
	}
	return false;
}

function isUsed(myrow, myimage) {
	//WARNING - may lock up if there are not enough images to choose from!
	var icount = 0;
	var xpos = 0;
	var ypos = 0;

	for(xpos=1; xpos<=7; xpos++){
		for(ypos=1; ypos<=5; ypos++){
			myvalue = ScreenMemory[ypos][xpos]
			if(myvalue == myimage) {
				return true;
			}			
		}
	}
	return false;
}



function setImage(title_type,mycell,title_silo,title_photo,myrow,mycol) {
	switch(title_type) {
		case 1:	// grey
			ScreenMemory[myrow][mycol]="#a7a9ac"
			document.getElementById(mycell).style.backgroundColor="#a7a9ac";
			break;
		case 2:	// dark-grey
			ScreenMemory[myrow][mycol]="#818285"
			document.getElementById(mycell).style.backgroundColor="#818285";
			break;
		case 3: // tan
			ScreenMemory[myrow][mycol]="#bc9b6a"
			document.getElementById(mycell).style.backgroundColor="#bc9b6a";
			break;
		case 4: // silohette
			ScreenMemory[myrow][mycol]="s"+title_silo+".jpg"
			mypic = "url(./images/homepage/slideshow/"+ScreenMemory[myrow][mycol]+")";
			document.getElementById(mycell).style.backgroundImage = mypic;
			break;
		case 5:	// photo
			ScreenMemory[myrow][mycol]="p"+title_photo+".jpg"
			mypic = "url(./images/homepage/slideshow/"+ScreenMemory[myrow][mycol]+")";
			document.getElementById(mycell).style.backgroundImage = mypic;
			break;
	}

}


// Opacity and Fade in script.
// Script copyright (C) 2008 http://www.cryer.co.uk/.
// Script is free to use provided this copyright header is included.
function SetOpacity(object,opacityPct)
{
  // IE.
  object.style.filter = 'alpha(opacity=' + opacityPct + ')';
  // Old mozilla and firefox
  object.style.MozOpacity = opacityPct/100;
  // Everything else.
  object.style.opacity = opacityPct/100;
}
function ChangeOpacity(id,msDuration,msStart,fromO,toO)
{
  var element=document.getElementById(id);
  var opacity = element.style.opacity * 100;
  var msNow = (new Date()).getTime();
  opacity = fromO + (toO - fromO) * (msNow - msStart) / msDuration;
  if (opacity<0) 
    SetOpacity(element,0)
  else if (opacity>100)
    SetOpacity(element,100)
  else
  {
    SetOpacity(element,opacity);
    element.timer = window.setTimeout("ChangeOpacity('" + id + "'," + msDuration + "," + msStart + "," + fromO + "," + toO + ")",1);
  }
}
function FadeIn(id)
{
  var element=document.getElementById(id);
  if (element.timer) window.clearTimeout(element.timer); 
  var startMS = (new Date()).getTime();
  element.timer = window.setTimeout("ChangeOpacity('" + id + "',1000," + startMS + ",0,100)",1);
}

function FadeOut(id)
{
  var element=document.getElementById(id);
  if (element.timer) window.clearTimeout(element.timer); 
  var startMS = (new Date()).getTime();
  element.timer = window.setTimeout("ChangeOpacity('" + id + "',1000," + startMS + ",100,0)",1);
}
function FadeInImage(foregroundID,newImage,backgroundID)
{
  var foreground=document.getElementById(foregroundID);
  if (backgroundID)
  {
    var background=document.getElementById(backgroundID);
    if (background)
    {
      background.style.backgroundImage = 'url(' + foreground.src + ')';
      background.style.backgroundRepeat = 'no-repeat';
    }
  }
  SetOpacity(foreground,0);
  foreground.src = newImage;
  if (foreground.timer) window.clearTimeout(foreground.timer); 
  var startMS = (new Date()).getTime();
  foreground.timer = window.setTimeout("ChangeOpacity('" + foregroundID + "',1000," + startMS + ",0,100)",10);
}


function init(){
	
	win_width=document.body.clientWidth
	win_height=document.body.clientHeight
	pic_width=document.getElementById("mypic").width
	pic_height=document.getElementById("mypic").height

//	posy=(win_height / 2 ) - (pic_height/2);
	posy=15;
	
	// initial centering of the graphic	
	leftx=win_width / 2 - pic_width
	document.getElementById("scroll").style.left = leftx
	document.getElementById("scroll").style.top = posy 
		
	win_width2=document.body.clientWidth
	win_height2=document.body.clientHeight
	pic_width2=document.getElementById("mypic2").width
	pic_height2=document.getElementById("mypic2").height
	
	
	// initial centering of the graphic	
	rightx=win_width2 / 2 
	document.getElementById("scroll2").style.left = rightx 

	document.getElementById("scroll2").style.top = posy
	
	movex = 1
	
}

function splitscreen() {

//	for(movex=1;movex<=400;movex=movex+1){
	
	timer = 0;	
	next();
		
		
//	}
}

function next() {
	if(movex<360){
		shiftimage = 10;
		document.getElementById("scroll").style.left = leftx
		leftx-= shiftimage
		document.getElementById("scroll2").style.left = rightx
		rightx+= shiftimage
		movex += shiftimage
	
		timer = setTimeout("next()",10);
		if(movex>400){
			clearTimeout(timer);
		}
	}
}


var ScreenMemory = new Array(7);
ScreenMemory[0] = new Array(8);
ScreenMemory[1] = new Array(8);
ScreenMemory[2] = new Array(8);
ScreenMemory[3] = new Array(8);
ScreenMemory[4] = new Array(8);
ScreenMemory[5] = new Array(8);
ScreenMemory[6] = new Array(8);

ScreenMemory[1][1] = "#a7a9ac";
ScreenMemory[1][2] = "s7.jpg";
ScreenMemory[1][3] = "#818285";
ScreenMemory[1][4] = "#bc9b6a";
ScreenMemory[1][5] = "#a7a9ac";
ScreenMemory[1][6] = "p2.jpg";
ScreenMemory[1][7] = "#a7a9ac";

ScreenMemory[2][1] = "#818285";
ScreenMemory[2][2] = "#bc9b6a";
ScreenMemory[2][3] = "p12.jpg";
ScreenMemory[2][4] = "#a7a9ac";
ScreenMemory[2][5] = "s5.jpg";
ScreenMemory[2][6] = "#818285";
ScreenMemory[2][7] = "#bc9b6a";

ScreenMemory[3][1] = "#a7a9ac";
ScreenMemory[3][2] = "p6.jpg";
ScreenMemory[3][3] = "#818285";
ScreenMemory[3][4] = "#bc9b6a";
ScreenMemory[3][5] = "#a7a9ac";
ScreenMemory[3][6] = "p3.jpg";
ScreenMemory[3][7] = "#a7a9ac";

ScreenMemory[4][1] = "#818285";
ScreenMemory[4][2] = "#bc9b6a";
ScreenMemory[4][3] = "p9.jpg";
ScreenMemory[4][4] = "#a7a9ac";
ScreenMemory[4][5] = "s2.jpg";
ScreenMemory[4][6] = "#818285";
ScreenMemory[4][7] = "#bc9b6a";

ScreenMemory[5][1] = "#a7a9ac";
ScreenMemory[5][2] = "s10.jpg";
ScreenMemory[5][3] = "#818285";
ScreenMemory[5][4] = "#bc9b6a";
ScreenMemory[5][5] = "#a7a9ac";
ScreenMemory[5][6] = "p16.jpg";
ScreenMemory[5][7] = "#a7a9ac";

//set overscan areas
ScreenMemory[0][1] = "";
ScreenMemory[0][2] = "";
ScreenMemory[0][3] = "";
ScreenMemory[0][4] = "";
ScreenMemory[0][5] = "";
ScreenMemory[0][6] = "";
ScreenMemory[0][7] = "";
ScreenMemory[0][8] = "";
ScreenMemory[1][0] = "";
ScreenMemory[1][8] = "";
ScreenMemory[2][0] = "";
ScreenMemory[2][8] = "";
ScreenMemory[3][0] = "";
ScreenMemory[3][8] = "";
ScreenMemory[4][0] = "";
ScreenMemory[4][8] = "";
ScreenMemory[5][0] = "";
ScreenMemory[5][8] = "";
ScreenMemory[6][0] = "";
ScreenMemory[6][1] = "";
ScreenMemory[6][2] = "";
ScreenMemory[6][3] = "";
ScreenMemory[6][4] = "";
ScreenMemory[6][5] = "";
ScreenMemory[6][6] = "";
ScreenMemory[6][7] = "";
ScreenMemory[6][8] = "";


function setScreen() {
	var xpos=0;
	var ypos=0;
	var mycell = "";
	var myvalue = "";
	var mypic = "";
	for(xpos=1; xpos<=7; xpos++){
		for(ypos=1; ypos<=5; ypos++){
			myvalue = ScreenMemory[ypos][xpos]
			mycell = "r"+ypos+"c"+xpos;
			
			if(myvalue.substr(1,1)=="#") {
				// Color
				document.getElementById(uppermycell).style.backgroundImage = "none";
				document.getElementById(mycell).style.backgroundColor="#a7a9ac";
			} else {
				// Picture
				mypic = "url(./images/homepage/slideshow/"+myvalue+")";
				document.getElementById(mycell).style.backgroundImage = mypic;				
			}
			
		}
	}
}

function returnCellType(myrow,mycol) {
	if (ScreenMemory[myrow][mycol]=="#a7a9ac") return 1
	if (ScreenMemory[myrow][mycol]=="#818285") return 2
	if (ScreenMemory[myrow][mycol]=="#bc9b6a") return 3
	if (ScreenMemory[myrow][mycol].substr(0,1)=="s") return 4
	if (ScreenMemory[myrow][mycol].substr(0,1)=="p") return 5	
	return 0
}
