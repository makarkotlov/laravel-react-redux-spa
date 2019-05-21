import { SIGNIN_SUCCESS } from '../../constants/actionTypes'
import { SIGNIN_ERROR } from '../../constants/actionTypes'
import { SIGNOUT_SUCCESS } from '../../constants/actionTypes'
import { SIGNOUT_ERROR } from '../../constants/actionTypes'
import { SIGNUP } from '../../constants/actionTypes'

export const signIn = credentials => (dispatch, getState) =>
	axios
		.post('login', credentials)
		.then(response => {
			console.log('Signin succes ' + response.data.user)
			dispatch({
				type: SIGNIN_SUCCESS,
				credentials,
				uid: response.data.user,
			})
		})
		.catch(error => {
			console.log(error)
			dispatch({ type: SIGNIN_ERROR, error })
		})

export const signOut = () => dispatch =>
	axios
		.post('logout')
		.then(response => {
			console.log('Signout success ' + response.status)
			dispatch({ type: SIGNOUT_SUCCESS })
		})
		.catch(error => {
			console.log(error)
			dispatch({ type: SIGNOUT_ERROR, error })
		})

export const signUp = credentials => dispatch =>
	dispatch({ type: SIGNUP, credentials: credentials })
