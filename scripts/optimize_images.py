import argparse
import os
from pathlib import Path

from PIL import Image


def human_size(num_bytes: int) -> str:
    for unit in ["B", "KB", "MB", "GB"]:
        if num_bytes < 1024:
            return f"{num_bytes:.0f} {unit}"
        num_bytes /= 1024
    return f"{num_bytes:.1f} TB"


def resize_if_needed(img: Image.Image, max_w: int, max_h: int) -> Image.Image:
    if max_w <= 0 and max_h <= 0:
        return img
    w, h = img.size
    target_w = max_w if max_w > 0 else w
    target_h = max_h if max_h > 0 else h
    scale = min(target_w / w, target_h / h, 1.0)
    if scale >= 1.0:
        return img
    new_size = (int(w * scale), int(h * scale))
    return img.resize(new_size, Image.LANCZOS)


def optimize_image(src: Path, dst: Path, quality: int, png_compress: int, max_w: int, max_h: int) -> tuple[int, int]:
    before = src.stat().st_size
    with Image.open(src) as img:
        img = resize_if_needed(img, max_w, max_h)
        fmt = (img.format or src.suffix.lstrip(".")).upper()

        dst.parent.mkdir(parents=True, exist_ok=True)

        if fmt in ["JPG", "JPEG"]:
            rgb = img.convert("RGB")
            rgb.save(dst, quality=quality, optimize=True, progressive=True)
        elif fmt == "PNG":
            # Keep alpha if present. PNG optimization only (no lossy quantization).
            img.save(dst, optimize=True, compress_level=png_compress)
        else:
            # Fallback: re-save with optimize where possible.
            img.save(dst, optimize=True)

    after = dst.stat().st_size
    return before, after


def main() -> None:
    parser = argparse.ArgumentParser(description="Reduce image file sizes for the portfolio.")
    parser.add_argument("--input", default="assets/img", help="Input directory (default: assets/img)")
    parser.add_argument("--output", default="assets/img/optimized", help="Output directory (default: assets/img/optimized)")
    parser.add_argument("--in-place", action="store_true", help="Overwrite originals instead of writing to output dir")
    parser.add_argument("--quality", type=int, default=80, help="JPEG quality (default: 80)")
    parser.add_argument("--png-compress", type=int, default=9, help="PNG compress level 0-9 (default: 9)")
    parser.add_argument("--max-width", type=int, default=1600, help="Resize max width (0 to disable, default: 1600)")
    parser.add_argument("--max-height", type=int, default=1600, help="Resize max height (0 to disable, default: 1600)")
    args = parser.parse_args()

    input_dir = Path(args.input)
    if not input_dir.exists():
        raise SystemExit(f"Input directory not found: {input_dir}")

    output_dir = Path(args.output)

    total_before = 0
    total_after = 0
    count = 0

    for src in input_dir.rglob("*"):
        if not src.is_file():
            continue
        if src.name == ".gitkeep":
            continue
        if src.suffix.lower() not in [".jpg", ".jpeg", ".png", ".webp"]:
            continue

        dst = src if args.in_place else output_dir / src.relative_to(input_dir)
        before, after = optimize_image(src, dst, args.quality, args.png_compress, args.max_width, args.max_height)
        total_before += before
        total_after += after
        count += 1
        print(f"{src.name}: {human_size(before)} -> {human_size(after)}")

    if count == 0:
        print("No images found.")
        return

    savings = total_before - total_after
    percent = (savings / total_before * 100) if total_before else 0
    print("")
    print(f"Total: {human_size(total_before)} -> {human_size(total_after)} (-{human_size(savings)}, {percent:.1f}%)")
    if not args.in_place:
        print(f"Output folder: {output_dir}")


if __name__ == "__main__":
    main()
