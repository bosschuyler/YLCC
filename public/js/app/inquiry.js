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

inquiry.list = (function() {
	var obj = {};
	obj.url = '';
	obj.iconClass = 'glyphicon';
	obj.data = {
		page: 1,
		order: 'created',
		order_type: 'desc',
		search: '',
		status: 'New'
	}
	
	/* UTILITY */
	obj.getIcon = function(type) {
		if(type == 'asc') {
			return 'glyphicon-arrow-up';	
		} 
		return 'glyphicon-arrow-down';
	}
	obj.orderFlip = function(type) {
		if(type == 'asc') {
			return 'desc';
		} 
		return 'asc';
	}
	obj.removeSortIcon = function() {
		jQuery('.' + obj.iconClass).remove();	
	}
	obj.generateSortIcon = function() {
		var icon = jQuery('<i></i>');
		icon.addClass(obj.iconClass);
		icon.addClass(obj.getIcon(obj.data.order_type));
		return icon;
	}
	
	
	/* SET PROPERTIES */	
	obj.setUrl = function(url) {
		obj.url = url;
	}	
	obj.setPage = function(page) {
		obj.data.page = page;
	}
	obj.setOrder = function(value) {
		obj.data.order = value;
	}	
	obj.setOrderType = function(value) {
		obj.data.order_type = value;	
	}	
	obj.setStatus = function(value) {
		obj.data.status = value;	
	}	
	obj.setSearch = function(value) {
		obj.data.search = value;
	}
	
	//EXECUTE THE QUERY FROM PROPERTIES
	obj.query = function() {
		jQuery.ajax({
			url: obj.url,
			data: obj.data,
			success: function(data) {
				jQuery('#list-content').html(data);	
			}
		});
	}
	
	
	/* HANDLER FUNCTIONS */	
	obj.searchHandler = function() {
		var self = this;
		obj.setSearch(self.value);
		obj.setPage(1);
		obj.query();
	}
	obj.orderHandler = function() {
		var self = this;
		
		var order_type = '';
		var order = '';
		
		//check if the clicked item was current sort
		//if so, flip the sort type.
		//otherwise, retrieve default sort type.
		if(jQuery(self).hasClass('active')) {
			var current = jQuery(self).data('order-type');
			order_type = obj.orderFlip(current);
			jQuery(self).data('order-type', order_type);
		} else {
			jQuery('.sort-link').removeClass('active');
			jQuery(self).addClass('active');
			order_type = jQuery(self).data('default')
		}
		
		//retrieve the order from the DOM.
		order = jQuery(self).data('order');
		
		//set the properties of the list object.
		obj.setOrder(order);
		obj.setOrderType(order_type);
		obj.setPage(1);
		
		//remove the old icon and generate a new one.
		obj.removeSortIcon();
		jQuery(self).append(obj.generateSortIcon());
				
		obj.query();
	}	
	obj.pageHandler = function() {
		var self = this;
		
		//retrieve the page from the DOM
		var page = jQuery(self).data('page');
		
		//set the properiest of the list object.
		obj.setPage(page);
		obj.query();
	}	
	obj.statusHandler = function() {
		var self = this;
		
		//retrieve data from the DOM object.
		var status = jQuery(self).data('status');
		
		//manipulate the DOM accordingly
		jQuery('.status-link').removeClass('active');
		jQuery(self).addClass('active');
		
		//set properties of the list object.
		obj.setStatus(status);
		obj.setPage(1);		
		obj.query();		
	}
		
	return obj;
})();
	
jQuery(document).ready(function(){
	//retrieve the action url from the DOM and set the object.
	var Url = jQuery('#list-content').data('url');
	inquiry.list.setUrl(Url);
	
	//bind the event handling functions to the DOM
	jQuery(document).on('keyup', '#search', inquiry.list.searchHandler);
	jQuery(document).on('click', '.sort-link', inquiry.list.orderHandler);
	jQuery(document).on('click', '.pagination-link', inquiry.list.pageHandler);
	jQuery(document).on('click', '.status-link', inquiry.list.statusHandler);
	jQuery(document).on('click', '.update-status', inquiry.updateHandler);
});