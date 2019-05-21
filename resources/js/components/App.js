import React from 'react'
import ReactDOM from 'react-dom'
import { BrowserRouter, Switch, Route } from 'react-router-dom'
import CreateProject from './projects/CreateProject'
import { createStore, applyMiddleware } from 'redux'
import rootReducer from '../store/reducers/rootReducer'
import { Provider } from 'react-redux'
import thunk from 'redux-thunk'
import { createBrowserHistory } from 'history'
import './App.css'
import Navbar from './layouts/Navbar'
import Dashboard from './dashboard/Dashboard'
import ProjectDetails from './projects/ProjectDetails'
import SignIn from './auth/SignIn'
import SignUp from './auth/SignUp'

const history = createBrowserHistory()
const store = createStore(rootReducer, applyMiddleware(thunk)) //thunk is a middleware that stops the dispatching of updating the state of the component to perform some actions like async requests

const App = () => (
	<BrowserRouter>
		<div className="App">
			<Navbar />
			<Switch>
				<Route exact path="/user" component={Dashboard} />
				<Route path="/project/:id" component={ProjectDetails} />
				<Route path="/signin" component={SignIn} history={history} />
				<Route path="/signup" component={SignUp} history={history} />
				<Route path="/create" component={CreateProject} />
			</Switch>
		</div>
	</BrowserRouter>
)

ReactDOM.render(
	<Provider store={store}>
		<App />
	</Provider>,
	document.getElementById('app')
)
