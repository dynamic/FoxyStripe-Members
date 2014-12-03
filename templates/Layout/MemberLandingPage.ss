<div class="sixteen columns alpha omega half-bottom crumbs">
    $Breadcrumbs
</div>
<div class="sixteen columns typography NoSlide">
    <article>
        <h2>$Title</h2>
        <% if $SubTitle %><h3>$SubTitle</h3><% end_if %>
        <div class="content typography">$Content</div>
    </article>

    <% if $OrderHistory %>
        <% with $OrderHistory %>
            <div class="one-third column alpha">
                <h4><a href="$Link">$Title</a></h4>
                <div class="typography">$Content</div>
                <p><button onclick="location.href = '$Link';">My Orders</button></p>
            </div>
        <% end_with %>
    <% end_if %>

    <% if $MemberPage %>
        <% with $MemberPage %>
            <div class="one-third column">
                <h4><a href="$Link">$Title</a></h4>
                <div class="typography">$ProfileContent</div>
                <p><button onclick="location.href = '$Link';">Edit Account</button></p>
            </div>
        <% end_with %>
    <% end_if %>

    <div class="one-third column omega">
        <h4><a href="/Security/logout?BackURL=$Link">Logout</a></h4>
        <p>Logout of your account.</p>
        <p><button onclick="location.href = '/Security/logout?BackURL=$Link';">Logout</button> </p>
    </div>

    $Form
    $PageComments
</div>