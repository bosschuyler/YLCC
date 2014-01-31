// JavaScript Document
var nav = {	
	create: function(selector) {
		var self = this;
		this.elementSelector = jQuery(selector);
		
		this.state = 'closed';	
		this.getState = function() {
			return self.state;	
		}
		this.setState = function(value) {
			self.state = value;	
		}
		this.toggleState = function() {
			var data = self.getStateData(self.getState());	
			self.setState(data.flip);
		}
		
		this.states = {
			open: {
				icon: 'glyphicon-minus',
				flip: 'closed'
			},
			closed: {
				icon: 'glyphicon-plus',
				flip: 'open'
			}
		}
		this.getStateData = function(value) {
			return this.states[value];
		}
		
		this.iconContainer = 'toggle-icon';	
		this.getIconContainer = function() {
			return self.iconContainer;	
		}

		this.hiddenClass = 'hidden-xs';
		this.getHiddenClass = function() {
			return self.hiddenClass;	
		}
		
		this.toggleIcon = function() {
			var currentState = self.getStateData(self.getState());
			var newState = self.getStateData(currentState.flip);
			jQuery('.' + self.getIconContainer()).removeClass(currentState.icon).addClass(newState.icon);
		}
		
		this.toggleHandler = function() {						
			if(self.getState() == 'open') {
				self.hide();
			} else {
				self.show();	
			}
			self.toggleIcon();
			self.toggleState();			
		}
		
		this.show = function() {
			this.elementSelector.removeClass(self.getHiddenClass());
		}
		this.hide = function() {
			this.elementSelector.addClass(self.getHiddenClass());	
		}
	}
}


jQuery(document).ready(function(){
	var menu = new nav.create('.toggleable');	
	jQuery(document).on('click', '.menu-toggle', menu.toggleHandler);
});