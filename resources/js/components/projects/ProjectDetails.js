import React from 'react'

const ProjectDetails = ({ match }) => (
	<div className="container section project-details">
		<div className="card z-depth-0">
			<div className="card-content">
				<span className="card-title">
					Project Title - {match.params.id}
				</span>
				<p>
					Lorem ipsum dolor sit amet consectetur, adipisicing elit. Ea
					eveniet laudantium sequi, adipisci rem saepe quam et nam,
					eaque vero inventore ullam blanditiis neque quas sit
					corporis aspernatur voluptates velit!
				</p>
			</div>
			<div className="card-action grey lighten-4 grey-text">
				<div>Posted By</div>
				<div>3rd September</div>
			</div>
		</div>
	</div>
)

export default ProjectDetails
