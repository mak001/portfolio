<% if not $Pages || $Pages.Count == 1 %>
    <div>
        $Content
    </div>
<% end_if %>
<div class="mb-3 progress project-holder-nav">
    <div class="progress-bar bg-success h6 mb-3 mb-md-0">
        <a href="$Link" class="p-2">Projects</a>
    </div>
    <div class="progress-bar bg-warning h6 mb-3 mb-md-0">
        <a href="$LanguageLink" class="p-2">Langauges</a>
    </div>
    <div class="progress-bar bg-info h6 mb-3 mb-md-0">
        <a href="$FrameworkLink" class="p-2">Frameworks</a>
    </div>
</div>

<% if $PaginatedLanguages %>
    <div class="card-deck">
        <% loop $PaginatedLanguages %>
            <div class="col-md-6 col-xl-4 py-2 mx-auto">
                <div class="card uses">
                    <a href="$Link">
                        <h4 class="card-title" style="background-color: #$BGColor">$Title</h4>
                    </a>
                    <div class="card-block">
                        <p class="card-text">$Description</p>
                    </div>
                    <div class="card-footer">
                        <a href="$Link" class="btn btn-primary">Projects</a>
                    </div>
                </div>
            </div>
        <% end_loop %>
    </div>

    <% with $PaginatedLanguages %>
        <% include Pagination %>
    <% end_with %>

<% else_if $PaginatedFrameworks %>
    <div class="card-deck">
        <% loop $PaginatedFrameworks %>
            <div class="col-md-6 col-xl-4 py-2 mx-auto">
                <div class="card uses">
                    <a href="$Link">
                        <h4 class="card-title" style="background-color: #$BGColor">$Title</h4>
                    </a>
                    <div class="card-block">
                        <p class="card-text">$Description</p>
                    </div>
                    <div class="card-footer">
                        <a href="$Link" class="btn btn-primary">Projects</a>
                    </div>
                </div>
            </div>
        <% end_loop %>
    </div>

    <% with $PaginatedFrameworks %>
        <% include Pagination %>
    <% end_with %>

<% else_if $PaginatedProjects %>

    <% if $SelectedLanguage %>
        <div class="container row">
            <div class="col-md-8 col-lg-6 mx-auto text-center uses-header">
                <hr class="col-12"/>
                <h3>$SelectedLanguage.Title</h3>
                <p>$SelectedLanguage.Description</p>
                <hr class="col-12"/>
            </div>
        </div>
    <% end_if %>

    <% if $SelectedFramework %>
        <div class="container row">
            <div class="col-md-8 col-lg-6 mx-auto text-center uses-header">
                <hr class="col-12"/>
                <h3>$SelectedFramework.Title</h3>
                <p>$SelectedFramework.Description</p>
                <hr class="col-12"/>
            </div>
        </div>
    <% end_if %>


    <div class="card-deck">
        <% loop $PaginatedProjects %>
            <div class="col-md-6 col-xl-4 py-2 mx-auto">
                <div class="card project">

                    <a href="$Link">
                        <% if $MainPhoto %>
                            <img class="card-img-top img-fluid"
                                 src="$MainPhotoResizeLink(510, 200)"
                                 alt="$MainPhoto.ALT">
                        <% else %>
                            <img class="card-img-top img-fluid"
                                 src="/portfolio/img/code.png"
                                 alt="$Title Photo">
                        <% end_if %>
                    </a>

                    <div class="card-block">
                        <h4 class="card-title">$Title</h4>
                        <p class="card-text">
                            <% if $Teaser %>
                                $Teaser
                            <% else %>
                                $Content.FirstSentence
                            <% end_if %>
                        </p>
                    </div>

                    <div class="card-footer">
                        <div class="btn-container">
                            <a href="$Link" class="btn btn-primary">Details...</a>
                        </div>
                    </div>

                </div>
            </div>
        <% end_loop %>
    </div>
    <% with $PaginatedProjects %>
        <% include Pagination %>
    <% end_with %>

<% else %>
    <div class="no-projects">
        No projects found.
    </div>
<% end_if %>
