<% require css('https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0-alpha.6/css/bootstrap.min.css') %>
<% if $MainPhoto %>
    <% if $MainImageHasLogo %>
        <div class="jumbotron bg-info text-center $ExtraClasses" id="project-header"
             style="background-image: url($MainPhoto.FillMax(1110, 350).URL)">
            <h1 class="sr-only">$Title</h1>
        </div>
    <% else %>
        <div class="jumbotron bg-info text-center overlay $ExtraClasses" id="project-header"
             style="background-image: url($MainPhoto.FillMax(1110, 350).URL)">
            <div class="container">
                <h1 class="display-4">$Title</h1>
            </div>
        </div>
    <% end_if %>
<% else %>
    <div class="jumbotron bg-info text-center overlay $ExtraClasses" id="project-header"
         style="background-image: url('/portfolio/img/code.png')">
        <div class="container">
            <h1 class="display-4">$Title</h1>
        </div>
    </div>
<%end_if %>

<div class="row btn-container">
    <div class="container text-center text-md-left col-md-6 mb-3">
        <% if $Languages %>
            <h4>Languages</h4>
            <% loop $Languages %>
                <a href="$Link" class="btn btn-info $CssClass">$Title</a>
            <% end_loop %>
        <% end_if %>
    </div>

    <div class="container text-center text-md-right col-md-6 mb-3">
        <% if $Frameworks %>
            <h4>Frameworks</h4>
            <% loop $Frameworks %>
                <a href="$Link" class="btn btn-info $CssClass">$Title</a>
            <% end_loop %>
        <% end_if %>
    </div>
</div>
<div class="mb-3 text-center">
    <% if $ViewLinks %>
        <% loop $ViewLinks %>
            <a href="$ShowLink($Pos)" class="btn btn-info">$Title</a>
        <% end_loop %>
    <% end_if %>

    <% if $Sources %>
        <% loop $Sources %>
            <a href="$Link" target="_blank" class="btn btn-success">$Title</a>
        <% end_loop %>
    <% end_if %>
</div>

<div class="project-info">
    $Content
</div>
