
class wtlshapes{
  constructor(cid, shape, color, amount){
    this.cid = cid;
    this.shape = shape || "circle";
    this.color = color || "green";
    this.ocolor = color || "green";
    this.amount = amount;
	if(this.amount == 0){
      this.color = "gray";
	}
  }
  draw(){
    let startpx = parseInt(8 + this.getoffset());
    let c = document.getElementById(this.cid);
	let ctx = c.getContext("2d");
	ctx.clearRect(0, 0, c.width, c.height);
	if(this.shape == "circle"){
	  ctx.beginPath();
      ctx.arc(16,16,16,0,2*Math.PI);
      ctx.fillStyle = this.color;
      ctx.fill();
	  if(this.amount > 0 && this.cid.charAt() != "t"){
	    ctx.font = "8px";
        ctx.strokeText(this.amount.toString(), startpx, 20, 16);
      }
	}else if(this.shape == "square"){
      ctx.fillStyle = this.color;
      ctx.fillRect(0,0,32,32);
	  if(this.amount > 0 && this.cid.charAt() != "t"){
	    ctx.font = "8px";
        ctx.strokeText(this.amount.toString(), startpx, 20, 16);
      }
	}else if(this.shape == "triangle"){
      ctx.beginPath();
      ctx.moveTo(16, 0);
      ctx.lineTo(32, 32);
      ctx.lineTo(0, 32);
      ctx.lineTo(16, 0);
      ctx.fillStyle = this.color;
      ctx.fill();
	  if(this.amount > 0 && this.cid.charAt() != "t"){
	    ctx.font = "10px";
        ctx.strokeText(this.amount.toString(), startpx, 24, 16);
	  }
	}else if(this.shape == "crosshair"){
	  ctx.beginPath();
      ctx.arc(16,16,14,0,2*Math.PI);
      var x = c.width / 2;
      var y = c.height / 2;
      ctx.strokeWidth = 1;
      ctx.moveTo(x, y - 13);
      ctx.lineTo(x, y + 13);
      ctx.moveTo(x - 13,  y);
      ctx.lineTo(x + 13,  y);
      ctx.strokeStyle = 'white';
      ctx.stroke();
	}else if(this.shape == "stack"){
      ctx.strokeWidth = 1;
      ctx.moveTo(3, 29);
      ctx.lineTo(29, 29);
      ctx.lineTo(29, 23);
      ctx.lineTo(3, 23);
	  ctx.lineTo(3, 29);
      ctx.moveTo(3, 20);
	  ctx.lineTo(29, 20);
	  ctx.lineTo(29, 14);
	  ctx.lineTo(3, 14);
	  ctx.lineTo(3, 20);
      ctx.moveTo(3, 11);
      ctx.lineTo(29, 11);
      ctx.lineTo(29, 5);
      ctx.lineTo(3, 5);
      ctx.lineTo(3, 11);
      ctx.strokeStyle = 'white';
      ctx.stroke();
	}else if(this.shape == "bar"){
	  var x = c.width / 2;
	  var y = c.height / 2;
	  x = x - 10;
	  y = y + 25;
	  ctx.fillStyle = 'white';
      ctx.fillRect(x,0 + (100-parseInt(this.amount)),17,parseInt(this.amount));
	  if(this.amount > 0){
	    ctx.font = "10px";
		if(this.amount < 29){
		  ctx.strokeStyle = 'white';
		}
        ctx.strokeText(this.amount.toString(), x+this.getoffset(), y, 16);
	  }
	}
  }
  /*add(){
    this.amount = parseInt(this.amount)+1;
	if(this.amount > 0 && this.color != this.ocolor){
      this.color = this.ocolor;
	}
  }
  substract(){
    this.amount=parseInt(this.amount)-1;
	if(this.amount < 1){
	  this.color = "gray";
	}
  }
  getoffset(){
    if(this.amount < 100){
	  if(this.amount < 10){
	    return 5;
	  }else{
	    return 3;
	  }
	}else{
      return 0;	
	}
  }*/
  add(){
    this.amount = parseInt(this.amount) + 1, 0 < this.amount && this.color != this.ocolor && (this.color = this.ocolor);
  }
  substract(){
    this.amount = parseInt(this.amount) - 1, 1 > this.amount && (this.color = "gray");
  }
  getoffset(){
    return 100 > this.amount ? 10 > this.amount ? 5 : 3 : 0;
  }
}

function click_source_item(event, canvasid){
  var o = getById(canvasid, sourcegrid);
  if(event.button == 0){
    if(o.amount < 999){
      o.add();
	  o.draw();
	}
  }else if(event.button == 2){
    if(o.amount > 0){
      o.substract();
	  o.draw();
	}
  }
}

function getById(id, arr){
  for(let j = 0; j < arr.length; j++){
    if(arr[j].cid == id){
      return arr[j];
    }
  }
}

function getJSON(target){
  var c = document.querySelector("#jsondata");
  var b = document.querySelector("#"+target);
  var t = document.createElement('INPUT');
  document.body.appendChild(t);
  t.setAttribute('value', c.innerHTML)
  t.select();
  document.execCommand('copy');
  document.body.removeChild(t);
  b.classList.add('copied');
  setTimeout(function(){
    b.classList.remove('copied');
  }, 2000);
}

window.wtlshapes = wtlshapes;
window.sourcegrid = [];
window.targetgrid = [];