/***********************
* Adobe Edge Animate Composition Actions
*
* Edit this file with caution, being careful to preserve 
* function signatures and comments starting with 'Edge' to maintain the 
* ability to interact with these actions from within Adobe Edge Animate
*
***********************/
(function($, Edge, compId){
var Composition = Edge.Composition, Symbol = Edge.Symbol; // aliases for commonly used Edge classes

   //Edge symbol: 'stage'
   (function(symbolName) {
      
      
      Symbol.bindTriggerAction(compId, symbolName, "Default Timeline", 3071, function(sym, e) {
         // insert code here
         sym.stop();

      });
      //Edge binding end
 

      Symbol.bindElementAction(compId, symbolName, "${cerrar2}", "click", function(sym, e) {
         // insert code for mouse click here
         // Play the timeline at a label or specific time. For example:
         // sym.play(500); or sym.play("myLabel");
         sym.play("play");
         setTimeout(function(){ 
        	 $(".pbl-union").fadeOut();
         }, 1500);
         
      });
      //Edge binding end

      Symbol.bindTriggerAction(compId, symbolName, "Default Timeline", 5000, function(sym, e) {
         
         sym.stop();

      });
      //Edge binding end

      Symbol.bindTriggerAction(compId, symbolName, "Default Timeline", 2000, function(sym, e) {
         // insert code here
         // Play a video track 
         sym.$("video")[0].play();

      });
      //Edge binding end

      Symbol.bindTriggerAction(compId, symbolName, "Default Timeline", 3750, function(sym, e) {
         // insert code here
         // Pause a video track 
         sym.$("video")[0].pause();

      });
      //Edge binding end

      Symbol.bindTriggerAction(compId, symbolName, "Default Timeline", 0, function(sym, e) {
         // insert code here
         sym.stop();

      });
      //Edge binding end

      Symbol.bindElementAction(compId, symbolName, "${boton_abre}", "click", function(sym, e) {
         // insert code for mouse click here
         sym.play();
         

      });
      //Edge binding end

   })("stage");
   //Edge symbol end:'stage'

   //=========================================================
   
   //Edge symbol: 'cerrar'
   (function(symbolName) {   
   
      Symbol.bindElementAction(compId, symbolName, "${cerrar}", "click", function(sym, e) {
         // insert code for mouse click here
         // Play the timeline at a label or specific time. For example:
         // sym.play(500); or sym.play("myLabel");
         sym.play("play");
         
         setTimeout(function(){ 
        	 $(".pbl-union").fadeOut();
         }, 1500);
         
      });
         //Edge binding end

   })("cerrar");
   //Edge symbol end:'cerrar'

   //=========================================================
   
   //Edge symbol: 'contenedor_video'
   (function(symbolName) {   
   
      Symbol.bindSymbolAction(compId, symbolName, "creationComplete", function(sym, e) {
         var visorvideo =sym.$ ("video");
         var reproductor =  '<iframe width="560" height="315" src="https://www.youtube.com/embed/6ULZIz34wyY?rel=0&amp;controls=0&amp;showinfo=0" frameborder="0" allowfullscreen></iframe>';
         visorvideo.html(reproductor);
         
         

      });
      //Edge binding end

   })("contenedor_video");
   //Edge symbol end:'contenedor_video'

})(window.jQuery || AdobeEdge.$, AdobeEdge, "EDGE-28231535");