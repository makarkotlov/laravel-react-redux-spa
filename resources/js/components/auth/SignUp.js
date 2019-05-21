import React, { Component } from 'react'
import { signUp } from '../../store/actions/authActions'
import { connect } from 'react-redux'

class SignUp extends Component {
	state = {
		email: '',
		password: '',
		firstName: '',
		lastName: '',
    }

	handleChange = e => {
		this.setState({
			[e.target.id]: e.target.value,
		})
    }

	handleSubmit = e => {
		e.preventDefault()
		this.props.signUp(this.state)
    }

	render() {
		return (
			<div className="container">
				<form onSubmit={this.handleSubmit} className="white">
					<h5 className="grey-text text-darken-3">Sign Up</h5>
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
						<label htmlFor="firstName">First Name</label>
						<input
							type="text"
							id="firstName"
							onChange={this.handleChange}
						/>
					</div>
					<div className="input-field">
						<label htmlFor="lastName">Last Name</label>
						<input
							type="text"
							id="lastName"
							onChange={this.handleChange}
						/>
					</div>
					<div className="input-field">
						<button className="btn pink lighten-1 z-depth-0">
							SIGN UP
						</button>
					</div>
				</form>
			</div>
		)
	}
}

const mapDispatchToProps = dispatch => {
	return {
		signUp: credentials => dispatch(signUp(credentials)), //call the imported signIn action (where we making an async call and stopping the dispatch) and pass in an object (that we passing in as a parameter when calling this.props.createProject in submitHandler)
	}
}

export default connect(
	null,
	mapDispatchToProps
)(SignUp)
