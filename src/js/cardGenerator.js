const projectsDiv = document.querySelector("#projectsContainer");

generateCards(projects);

function generateCards(projects){
    for (let i = projects.length-1; i >= 0; i--) {
        projectsDiv.appendChild(generateCard(projects[i]));     
    }
}

function generateCard(project){
    let card = document.createElement("div");
    card.setAttribute("class", "row bg-dark timeline d-flex justify-content-center");

    card.innerHTML = `
    <div class="col-12 col-xl-4">
        <div class="card bg-dark">
            <a title="${project.projectName}" href="${project.link}" class="d-block card-header bg-dark text-center link-light bg-dark" target="_blank">
                <h2 class="text-center">
                    ${project.projectName}
                </h2>
            </a>
            <div class="card-body bg-dark text-center">
                <h3>${project.description}</h3>
                <div class="card-text">
                    ${generateProjectTechnologies(project.technologies)}
                </div>
            </div>
            <div class="card-footer bg-dark text-center">
                <span class="badge rounded-pill" style="background-color: ${project.langColor}"> </span>
                <span>${project.lang}</span>
            </div>
        </div>
    </div> 
    `   
    return card;
}

function generateProjectTechnologies(technologies){
    let output = "";
    technologies.forEach(technology => {
        output +=`<span class="badge m-1" style="color: ${technology.fontColor}; background-color: ${technology.color}">
        ${technology.name}
    </span>`;
    });
    return output;
}