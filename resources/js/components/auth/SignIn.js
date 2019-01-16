import React, { Component } from "react";
import { signIn } from "../../store/actions/authActions";
import { connect } from "react-redux";
import Echo from "laravel-echo";
// window.io = require("socket.io-client");

class SignIn extends Component {
    state = {
        email: "",
        password: ""
    };
    componentDidMount() {
        this.props.isAuth
            ? this.props.history.push("/dashboard")
            : console.log("isAuth: false");
    }
    componentDidUpdate() {
        this.props.isAuth
            ? this.props.history.push("/dashboard")
            : console.log("isAuth: false");
    }
    handleChange = e => {
        this.setState({
            [e.target.id]: e.target.value //we use id of elemets to change the corresponding names of the state
        });
    };
    handleSubmit = e => {
        e.preventDefault();
        // window.Echo = new Echo({
        //     broadcaster: "socket.io",
        //     host: window.location.hostname + ":6001"
        // });
        // window.Echo.disconnect();
        this.props.signIn(this.state);
    };
    render() {
        const { authError } = this.props;
        return (
            <div className="container">
                <form onSubmit={this.handleSubmit} className="white">
                    <h5 className="grey-text text-darken-3">Sign In</h5>
                    <div className="input-field">
                        <label htmlFor="email">Email</label>
                        <input
                            type="email"
                            id="email"
                            onChange={this.handleChange}
                        />
                    </div>
                    <div className="input-field">
                        <label htmlFor="password">Password</label>
                        <input
                            type="password"
                            id="password"
                            onChange={this.handleChange}
                        />
                    </div>
                    <div className="input-field">
                        <button className="btn pink lighten-1 z-depth-0">
                            LOGIN
                        </button>
                        <div className="red-text center">
                            {authError ? <p>authError</p> : null}
                        </div>
                    </div>
                </form>
            </div>
        );
    }
}

const mapStateToProps = state => {
    //make authError be accessible from props
    return {
        authError: state.auth.authError,
        isAuth: state.auth.isAuth
    };
};

const mapDispatchToProps = dispatch => {
    return {
        signIn: credentials => dispatch(signIn(credentials)) //call the imported signIn action (where we making an async call and stopping the dispatch) and pass in an object (that we passing in as a parameter when calling this.props.createProject in submitHandler)
    };
};

export default connect(
    mapStateToProps,
    mapDispatchToProps
)(SignIn); //we have to pass in a null instead of mapStateToProps 'cuz it's the need
