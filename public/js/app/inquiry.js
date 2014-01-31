// JavaScript Document
var inquiry = {	
	create: function() {
		this.data = {
			id: '',
			status: ''	
		};		
		
		this.setStatus = function(value) {
			this.data.status = value;	
		};
				
		this.setId = function(value) {
			this.data.id = value;
		};
				
		this.updateStatus = function(url, callback) {
			var self = this;
			jQuery.ajax({
				url: url,
				type: 'POST',
				data: self.data,
				success:function(data) {
					window.location = callback;
				}
			});
		}
	},
	updateHandler: function() {
		//retrieve the data off the DATA DOM
		var url = jQuery(this).data('url');
		var callback = jQuery(this).data('callback');	
		var status = jQuery(this).data('status');
		var id = jQuery(this).data('id');
		
		//create instance of the inquiry object.
		var temp = new inquiry.create();
		temp.setStatus(status);
		temp.setId(id);		
		temp.updateStatus(url, callback);
	}
}

inquiry.list = function(selector) {
	var self = this;
	
	this.wrapperElement = jQuery(selector);
	this.url = this.wrapperElement.data('url');
	this.baseIconClass = "glyphicon";
	
	this.data = {
		page: 1,
		order: 'created',
		order_type: 'desc',
		search: '',
		status: 'New'	
	}
	
	
	/* PROCESSING FUNCTIONS */			
		this.flipOrder = function() {
			if(this.getOrderType() == 'asc') {
				this.setOrderType('desc');
			} else {
				this.setOrderType('asc');	
			}
		}
		this.getIcon = function() {
			if(this.getOrderType() == 'asc') {
				return 'glyphicon-arrow-up';	
			} 
			return 'glyphicon-arrow-down';	
		}
		this.removeSortIcon = function() {
			jQuery('.' + this.getBaseIcon()).remove();	
		}	
		this.generateSortIcon = function() {
			var icon = jQuery('<i></i>');
			icon.addClass(this.getBaseIcon());
			icon.addClass(this.getIcon());
			return icon;
		}
	
	/* GETTERS/SETTERS */
		this.setUrl = function(url) {
			this.url = url;
		}	
		this.setPage = function(page) {
			this.data.page = page;
		}
		this.setOrder = function(value) {
			this.data.order = value;
		}	
		this.setOrderType = function(value) {
			this.data.order_type = value;	
		}	
		this.setStatus = function(value) {
			this.data.status = value;	
		}	
		this.setSearch = function(value) {
			this.data.search = value;
		}	
		this.getOrderType = function() {
			return this.data.order_type;	
		}
		this.getBaseIcon = function() {
			return this.baseIconClass;	
		}	
		this.getIcon = function() {
			if(this.getOrderType() == 'asc') {
				return 'glyphicon-arrow-up';	
			} 
			return 'glyphicon-arrow-down';	
		}
	
	//EXECUTE THE QUERY FROM PROPERTIES
	this.query = function() {
		jQuery.ajax({
			url: self.url,
			data: self.data,
			success: function(data) {
				jQuery(self.wrapperElement).html(data);
			}
		});
	}
	
	/* HANDLER FUNCTIONS */	
		this.searchHandler = function() {
			var element = this;
			self.setSearch(element.value);
			self.setPage(1);
			self.query();
		}
		this.orderHandler = function() {
			var element = this;
						
			var newOrder = jQuery(element).data('order')			
			var defaultType = jQuery(element).data('default');
				
			if(jQuery(element).hasClass('active')) {
				//flip the current sort-type
				self.flipOrder();
			} else {				
				//set the order-type to the default.
				self.setOrderType(defaultType);
			}
			
			self.setOrder(newOrder);
			self.setPage(1);
			
			//edit the DOM objects
			jQuery('.sort-link').removeClass('active');
			jQuery(element).addClass('active');
			self.removeSortIcon();
			var newIcon = self.generateSortIcon();
			jQuery(element).append(newIcon);		
			
			self.query();
		}	
		this.pageHandler = function() {
			var element = this;
			
			//retrieve the page from the DOM
			var page = jQuery(element).data('page');
			
			//set the properiest of the list object.
			self.setPage(page);
			self.query();
		}	
		this.statusHandler = function() {
			var element = this;
			
			//retrieve data from the DOM object.
			var status = jQuery(element).data('status');
			
			//manipulate the DOM accordingly
			jQuery('.status-link').removeClass('active');
			jQuery(element).addClass('active');
			
			//set properties of the list object.
			self.setStatus(status);
			self.setPage(1);		
			self.query();		
		}	
}

jQuery(document).ready(function(){
	var list = new inquiry.list('#list-content');
	
	//bind the event handling functions to the DOM
	jQuery(document).on('keyup', '#search', list.searchHandler);
	jQuery(document).on('click', '.sort-link', list.orderHandler);
	jQuery(document).on('click', '.pagination-link', list.pageHandler);
	jQuery(document).on('click', '.status-link', list.statusHandler);	
	jQuery(document).on('click', '.update-status', inquiry.updateHandler);
});