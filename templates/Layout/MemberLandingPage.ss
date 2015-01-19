<%-- redeclare Simple theme includes to keep correct inclusion order --%>
<% require themedCSS('reset') %>
<% require themedCSS('typography') %>
<% require themedCSS('layout') %>
<%-- FoxyStripe requirements --%>
<% require css('foxystripe/css/foxycart.css') %>

<% include SideBar %>
<div class="content-container unit size3of4 lastUnit">
    <h1>$Title</h1>

    <div class="content">
        $Content
    </div>
    
	<% if CurrentMember %>
	
		<% if $OrderHistory %>
	        <% with $OrderHistory %>
	            <div class="size1of3 unit">
	                <h4><a href="$Link">$Title</a></h4>
	                <div class="typography"><p>View your order history.</p></div>
	                <p><button onclick="location.href = '$Link';">My Orders</button></p>
	            </div>
	        <% end_with %>
	    <% end_if %>
		
		<% if $MemberPage %>
	        <% with $MemberPage %>
	            <div class="size1of3 unit">
	                <h4><a href="$Link">$Title</a></h4>
	                <div class="typography"><p>Edit your account information.</p></div>
	                <p><button onclick="location.href = '$Link';">Edit Account</button></p>
	            </div>
	        <% end_with %>
	    <% end_if %>
	
		<div class="size1of3 lastUnit">
	        <h4><a href="/Security/logout?BackURL=$Link">Logout</a></h4>
	        <p>Logout of your account.</p>
	        <p><button onclick="location.href = '/Security/logout?BackURL=$Link';">Logout</button> </p>
		</div>
	
	<% end_if %>

</div>