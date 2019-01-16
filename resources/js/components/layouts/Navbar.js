import React from "react";
import { Link } from "react-router-dom";
import SignedInLinks from "./SignedInLinks";
import SignedOutLinks from "./SignedOutLinks";
import { connect } from "react-redux";

const Navbar = props => {
    const { auth } = props;
    const links = auth ? <SignedInLinks /> : <SignedOutLinks />;
    return (
        <nav className="nav-wrapper grey darken-3">
            <div className="container">
                <Link to="/" className="brand-logo">
                    Task Manager
                </Link>
                {links}
            </div>
        </nav>
    );
};

const mapStateToProps = state => {
    return {
        auth: state.auth.isAuth
    };
};

export default connect(mapStateToProps)(Navbar);
