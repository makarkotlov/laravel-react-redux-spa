import React from "react";
import ProjectSummary from "./ProjectSummary";

const ProjectList = ({ projects }) => {
    return (
        <div className="project-list section">
            {projects &&
                projects.map(project => {
                    //if there's no projects don't bother mapping 'cuz there's nothing to map
                    return (
                        <ProjectSummary project={project} key={project.id} />
                    );
                })}
        </div>
    );
};

export default ProjectList;
