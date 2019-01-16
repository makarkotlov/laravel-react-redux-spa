import React, { Component } from "react";
import Notifications from "./Notifications";
import ProjectList from "../projects/ProjectList";
import { connect } from "react-redux";

class Dashboard extends Component {
    render() {
        const { projects } = this.props; //get mapped to state projects from props of this component and assign it to const projects
        return (
            <div className="dashboard container">
                <div className="row">
                    <div className="col s12 m6">
                        <ProjectList projects={projects} />
                    </div>
                    <div className="col s12 m5 offset-m1">
                        <Notifications />
                    </div>
                </div>
            </div>
        );
    }
}

const mapStateToProps = state => {
    return {
        projects: state.project.projects //attaching this object from the rootReducer, that points to the object of projectReducer, to the props of this component
    };
};
export default connect(mapStateToProps)(Dashboard);
