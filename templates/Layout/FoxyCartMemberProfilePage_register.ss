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

        <h2><%t MemberProfiles.LOGINHEADER "Log in" %></h2>
        <p><%t MemberProfiles.LOGIN "If you already have an account, you can <a href='{loginLink}'>log in here</a>." loginLink=$LoginLink %></p>

        <h2><%t MemberProfiles.REGISTER "Register" %></h2>
        $Form
    </div>
</div>