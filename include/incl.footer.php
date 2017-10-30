		<br />
	</body>
	
	
	
	<script>
	
		// Mark the flow icon as the active item
		function overviewHighlight(id) {
			$( id ) 
				.removeClass("grayout") 
				.removeClass("border-grayout") 
				.addClass("border-highlight") 
				.addClass("hand-pointer") 
				.click(function() { window.location = $(this).attr("url"); return false; });			
		}
		
		// Mark the flow icon as a non-active, clickable item
		function overviewDefault(id) {
			$( id )
				.addClass("border-default")
				.addClass("hand-pointer")
				.click(function() { window.location = $(this).attr("url"); return false; });			
		}

		// Mark the flow icon as a non-active, non-clickable item
		function overviewGrayout(id) {
			$( id )
				.addClass("border-grayout")
				.addClass("grayout")
				.removeClass("hand-pointer") 
				.unbind('click');		
		}
		
		// Mark the flow icon as the current, completed, non-clickable item
		function overviewGrayoutHighlight(id) {
			$( id )
				.addClass("border-highlight")
				.addClass("grayout")
				.removeClass("hand-pointer") 
				.unbind('click');		
		}		
	
	</script>
	
</html>
