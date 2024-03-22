<?php

namespace Miyamoto\Contracts\BaseOps;

/**
 * Defines a universal interface for transforming content. This interface focuses on processing or converting
 * content from one format or state to another, making it adaptable for various data transformation contexts,
 * such as data processing pipelines, content conversion services, or in-memory data manipulation.
 * Implementations are responsible for defining the transformation logic, ensuring the integrity of the transformed
 * data, and handling any transformation-specific requirements or constraints. Clear documentation on the expected
 * input and output formats, along with any configuration options, is essential.
 * Example Usage:
 * Converting CSV data to JSON:
 * ```php
 * $dataTransformer = new DataTransformer();
 * $jsonData = $dataTransformer->transform($csvData, 'CSV', 'JSON'); // Transform CSV data to JSON format
 * ```
 * Applying image filters:
 * ```php
 * $imageTransformer = new ImageTransformer();
 * $filteredImage = $imageTransformer->transform($originalImage, 'grayscale'); // Apply grayscale filter to image
 * ```
 * Transforming data from one format to another with a callable:
 * ```php
 * $transformer = new DataTransformer();
 * $result = $transformer->transform(
 *     function ($data) { return json_encode($data); }, // Transformer callable
 *     $sourceData, // Data to be transformed
 *     $destination // Destination for the transformed data (optional)
 * );
 * ```
 *
 * @author    Frank Wazeter <dev@wazeter.com>
 * @package   Miyamoto\Contracts
 * @since     0.0.3
 * @version   1.0.0
 * @copyright Copyright (c) 2024, Frank Wazeter
 * @license   See Package License.
 */
interface TransformInterface
{
	/**
	 * Transforms content from one format or state to another based on specified parameters or configurations.
	 *
	 * @return mixed The transformed content.
	 */
	public function transform (): mixed;
}
